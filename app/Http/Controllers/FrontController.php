<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Assessment;
use App\AssessmentAnswer;
use App\AssessmentResult;
use App\AssessmentScore;
use App\Customer;
use App\Http\Requests;
use App\Membercode;
use App\Notifications\CustomerScore;
use App\Notifications\RespondentScore;
use App\Question;
use App\Respondent;
use App\Services\AssessmentEvaluator;
use App\Services\ChartBuilder;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the homepage/dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.home');
    }

    /**
     * Show static page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPage()
    {
        $uri = \Request::route()->getName();
        $template = 'frontend.' . $uri;

        $pages = [
            'public' => ['home', 'privacy-policy', 'terms-of-service', 'thank-you'],
            'customer' => []
        ];

        if (View::exists($template) && (in_array($uri, $pages['public']) || in_array($uri, $pages['customer']))) {
            // If customer area page is requested without active login session
            if (in_array($uri, $pages['customer']) && (!session('customer_id') || session('customer_auth') !== true)) {
                return view('frontend.customer.login');
            }

            // Load requested page template
            return view($template);

        } else {
            // Load homepage template
            return view('frontend.home');
        }
    }

    /**
     * Show the enter membercode form.
     *
     * @return \Illuminate\Http\Response
     */
    public function enterMembercode()
    {
        if (session('membercode_id') && session('respondent_id')) {
            return redirect()->route('test');
        }

        return view('frontend.test.membercode');
    }

    /**
     * Verify the membercode and redirect to Respondent profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyMembercode(Request $request)
    {
        request()->validate([
            'membercode' => [
                'required',
                'alpha_num',
                'exists:membercodes,membercode'
            ]
        ]);

        $membercode = Membercode::where('membercode', $request->input('membercode'))->first();
        if ($membercode) {
            session([
                'membercode_id' => $membercode->id,
                'membercode'    => $membercode->membercode
            ]);

            return redirect()->route('register');

        } else {
            return redirect()->route('membercode')
                ->withErrors(['error' => trans('front.test.membercode_invalid')]);
        }
    }

    /**
     * Show the new Respondent profile form.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRespondent()
    {
        $membercode_id = session('membercode_id');

        if (!$membercode_id) {
            return redirect()->route('membercode');
        }

        $membercode = Membercode::findOrFail($membercode_id);

        return view('frontend.test.register', compact('membercode'));
    }

    /**
     * Store a newly created Respondent and redirect to Assessment form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRespondent(Request $request)
    {
        if (!session('membercode_id')) {
            return redirect()->route('membercode');
        }

        request()->validate([
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'last_name'  => 'required|regex:/^[\pL\s\-]+$/u',
            'gender'     => 'required|in:M,F,T,N,P',
            'adult'      => 'required|in:Y,N',
            'email'      => 'required|email',
            'gdpr'       => 'required'
        ]);

        $data = $request->except(['_token', 'gdpr']);
        $data['membercode_id'] = session('membercode_id');

        // Create Respondent object
        $respondent = Respondent::create($data);
        session(['respondent_id' => $respondent->id]);

        return redirect()->route('instructions');
    }

    /**
     * Show Test Instructions page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showInstructions()
    {
        // Validate Membercode
        if (!session('membercode_id')) {
            return redirect()->route('membercode');

            // Validate Respondent
        } else if (!session('respondent_id')) {
            return redirect()->route('register');
        }

        return view('frontend.test.instructions');
    }

    /**
     * Show the Assessment wizard form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assessmentWizard(Request $request)
    {
        // Test/Assessment wizard settings
        $num_questions = config('assessment.questions_number', 210);
        $per_page      = config('assessment.questions_per_page', 15);
        $total_pages   = (int) ($num_questions / $per_page);

        // Validate Respondent
        if (!session('respondent_id')) {
            return redirect()->route('register');
        }

        // Process submitted page answers (except last page)
        if (session('page_num') >= 1 && session('page_num') < $total_pages) {
            // Validate Assessment
            if (!session('assessment_id')) {
                return redirect()->back()->withInput()
                    ->withErrors(['paa_save_error' => trans('front.test.unknown_error')]);
            }

            // Validate quiz page inputs
            $q_inputs = $request->get('q');
            if (is_array($q_inputs) && count($q_inputs) == $per_page) {
                // Get database dictionary data for Questions & Answers
                $questions = Question::select('id', 'number')->pluck('id', 'number')->toArray();
                $answers   = Answer::select('id', 'answer')->pluck('id', 'answer')->toArray();

                // Store current page answers, create or update
                foreach ($q_inputs as $q_number => $answer) {
                    $asmt_answer = AssessmentAnswer::updateOrCreate(
                        ['assessment_id' => session('assessment_id'), 'question_id' => $questions[$q_number]],
                        ['answer_id' => $answers[$answer]]
                    );
                }

                // Define next page
                $page_num = Question::whereNotIn('id', function ($q) {
                    $q->select('question_id')
                        ->from('assessments_answers')
                        ->where('assessment_id', session('assessment_id'));
                })->min('group');

                // Check if Assessment Test is complete
                // FIXME: this is a sort of duplication to assessmentWizardFinish
                if (!$page_num) {
                    $this->sendNotifications();
                    // Assessment wizard was successfully completed!
                    return redirect()->route('thank-you');
                }

            } else {
                // Incomplete inputs, current page will be reloaded
                $page_num = session('page_num');
            }

        } else {
            // Start new Assessment
            $assessment = Assessment::create([
                'respondent_id' => session('respondent_id')
            ]);
            session(['assessment_id' => $assessment->id]);

            $page_num = 1;
        }

        session(['page_num' => $page_num]);
        $questions = Question::where('group', $page_num)->orderBy('number')->get();

        return view('frontend.test.test', compact('questions', 'page_num', 'total_pages'));
    }

    /**
     * Store a newly created Assessment and redirect to thank you page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assessmentWizardFinish(Request $request)
    {
        // Test/Assessment wizard settings
        $num_questions = config('assessment.questions_number', 210);
        $per_page      = config('assessment.questions_per_page', 15);
        $total_pages   = (int) ($num_questions / $per_page);

        // Validate Respondent
        if (!session('respondent_id')) {
            return redirect()->route('register');
        }

        // Validate Assessment
        if (!session('assessment_id')) {
            return redirect()->back()->withInput()
                ->withErrors(['paa_save_error' => trans('front.test.unknown_error')]);
        }

        // Validate is last page
        $page_num = session('page_num');
        if ($page_num != $total_pages) {
            // Reload previous page
            $questions = Question::where('group', $page_num)->orderBy('number')->get();

            return view('frontend.test.test', compact('questions', 'page_num', 'total_pages'));
        }

        // Validate quiz page inputs
        $q_inputs = $request->get('q');
        if (is_array($q_inputs) && count($q_inputs) == $per_page) {
            // Get database dictionary data for Questions & Answers
            $questions = Question::select('id', 'number')->pluck('id', 'number')->toArray();
            $answers   = Answer::select('id', 'answer')->pluck('id', 'answer')->toArray();

            // Store last page answers
            foreach ($q_inputs as $q_number => $answer) {
                $asmt_answer = AssessmentAnswer::updateOrCreate(
                    ['assessment_id' => session('assessment_id'), 'question_id' => $questions[$q_number]],
                    ['answer_id' => $answers[$answer]]
                );
            }

            $this->sendNotifications();
            // Assessment wizard was successfully completed!
            return redirect()->route('thank-you');

        } else {
            // Incomplete inputs, last page will be reloaded
            $questions = Question::where('group', $page_num)->orderBy('number')->get();

            return view('frontend.test.test', compact('questions', 'page_num', 'total_pages'));
        }
    }

    /**
     * Show the verify Assessment form.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyAssessment()
    {
        if (session('membercode_id') && session('respondent_id')) {
            return redirect()->route('test');
        }

        return view('frontend.test.verify');
    }

    /**
     * Verify if Assessment exists and is incomplete and requires finishing missing pages.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyAssessmentSubmit(Request $request)
    {
        request()->validate([
            'membercode' => [
                'required',
                'alpha_num',
                'exists:membercodes,membercode'
            ],
            'email' => 'required|email'
        ]);

        // Get corresponding membercode object
        $membercode = Membercode::where('membercode', $request->input('membercode'))->first();
        if (!$membercode) {
            return redirect()->route('test.verify')
                ->withErrors(['error' => trans('front.test.membercode_invalid')]);
        }

        // Get corresponding respondent object
        $respondent = Respondent::where('email', $request->input('email'))->first();
        if (!$respondent) {
            return redirect()->route('test.verify')
                ->withErrors(['error' => trans('front.test.email_not_found')]);
        }

        // Test/Assessment wizard settings
        $num_questions = config('assessment.questions_number', 210);
        $per_page      = config('assessment.questions_per_page', 15);
        $total_pages   = (int) ($num_questions / $per_page);

        // Find corresponding assessment object
        $assessment = Assessment::where('respondent_id', $respondent->id)->first();
        if (!$assessment) {
            // Start new Assessment
            $assessment = Assessment::create([
                'respondent_id' => session('respondent_id')
            ]);

            $page_num = 1;

            // Store all required session variables at once
            session([
                'membercode_id' => $membercode->id,
                'membercode'    => $membercode->membercode,
                'respondent_id' => $respondent->id,
                'assessment_id' => $assessment->id,
                'page_num'      => $page_num
            ]);

            $questions = Question::where('group', $page_num)->orderBy('number')->get();

            // Redirect to assessment first page
            return view('frontend.test.test', compact('questions', 'page_num', 'total_pages'));

        } else {
            // Existing assessment found and requires verification
            // Define first incomplete test page
            $page_num = Question::whereNotIn('id', function ($q) use ($assessment) {
                $q->select('question_id')
                    ->from('assessments_answers')
                    ->where('assessment_id', $assessment->id);
            })->min('group');

            if ($page_num) {
                // Store all required session variables at once
                session([
                    'membercode_id' => $membercode->id,
                    'membercode'    => $membercode->membercode,
                    'respondent_id' => $respondent->id,
                    'assessment_id' => $assessment->id,
                    'page_num'      => $page_num
                ]);

                $questions = Question::where('group', $page_num)->orderBy('number')->get();

                // Redirect to first incomplete test page
                return view('frontend.test.test', compact('questions', 'page_num', 'total_pages'));

            } else {
                $this->sendNotifications();
                // Assessment is complete - redirect to thank you page
                return redirect()->route('thank-you');
            }
        }
    }

    private function sendNotifications()
    {
        $respondent = Respondent::where('id', session('respondent_id'))->where('membercode_id', session('membercode_id'))->first();
        $membercode = Membercode::where('id', session('membercode_id'))->first();
        $id = session('assessment_id');
        //$customer = Customer::findOrFail($membercode->customer_id);
        $assessment = Assessment::findOrFail($id);
        // Check if assessment is complete with all answers
        if ($assessment->is_incomplete) {
            $error_msg = 'ERROR: The selected assessment is incomplete. Please contact system administrator for more information.';

            return back()->withErrors([$error_msg]);
        }

        // Create score graph image
        $score = AssessmentScore::where('assessment_id', $id)->get();
        // Evaluate assessment, calculate score and create graph/chart image
        if (!count($score)) {
                $data = [];
                foreach ($assessment->assessments_answers as $answer) {
                    $data[$answer->question_id] = $answer->answer->answer;
                }

            $evaluatorService = new AssessmentEvaluator();
            $respondentResults = $evaluatorService->evaluate($id, $data, $assessment->respondent->gender, $assessment->respondent->adult, 1);
            $customerResults = $evaluatorService->evaluate($id, $data, $assessment->respondent->gender, $assessment->respondent->adult, null);

            // Store results evaluation in html format
            AssessmentResult::create([
                'assessment_id' => $id,
                'content'       => $customerResults
            ]);

            // Create score graph image
            $score = AssessmentScore::where('assessment_id', $id)->get();
            $traitData = [];
            foreach ($score as $trait_score) {
                $traitData[$trait_score->trait->key] = $trait_score->score;
            }
            $chart = ChartBuilder::buildChartImage($traitData);

            // Store image on file server
            $chart_hash = substr(md5($id), 0, 16);
            $filename = 'images/score-charts/'. $chart_hash .'.png';
            $fp = fopen($filename, 'w');
            imagepng($chart, $fp);

            // Send Notifications
            $respondent->notify(new RespondentScore($respondent, $respondentResults));
            $membercode->customer->notify(new CustomerScore($membercode->customer, $customerResults));
            // Unset session variables since the found assessment is complete
            session()->forget('membercode_id');
            session()->forget('membercode');
            session()->forget('respondent_id');
            session()->forget('assessment_id');
            session()->forget('page_num');
        }
    }
}
