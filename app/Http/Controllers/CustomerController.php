<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Hash;

use App\Assessment;
use App\AssessmentAnswer;
use App\AssessmentResult;
use App\AssessmentScore;
use App\Customer;

use App\Services\AssessmentEvaluator;

class CustomerController extends Controller
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
     * Show the customer login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerAuth()
    {
        if (session('customer_id') && session('customer_auth') === true) {
            return view('frontend.home');
        }

        return view('frontend.customer.login');
    }

    /**
     * Authenticate customer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customerAuthLogin(Request $request)
    {
        request()->validate([
            'email'    => 'required|email|exists:customers,email',
            'password' => 'required'
        ]);

        // Find customer by email address
        $customer = Customer::where([
            ['email', '=', $request->input('email')],
            ['active', '=', 1]
        ])->first();

        // Validate password hash
        if ($customer && Hash::check($request->input('password'), $customer->password) === true) {
            session([
                'customer_id'   => $customer->id,
                'customer_auth' => true
            ]);

            // All good - redirect to requested route or account index
            $redirect = $request->input('_redirect');
            if (!$redirect || strpos($redirect, 'auth') === 0) {
                $redirect = 'account/index';
            }
            return redirect($redirect);

        } else {
            return redirect()->route('account.auth')
                ->withErrors(['password' => trans('front.auth.failed')]);
        }
    }

    /**
     * Logout customer, terminate session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customerAuthLogout(Request $request)
    {
        // Unset session variables since the PAA test is completed now
        $request->session()->forget('customer_id');
        $request->session()->forget('customer_auth');

        return view('frontend.customer.login');
    }

    /**
     * Display a listing of the assessments results for this customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function profileView()
    {
        if (!session('customer_id') || session('customer_auth') !== true) {
            return view('frontend.customer.login');
        }
        $customer = Customer::findOrFail(session('customer_id'));

        return view('frontend.customer.profile', compact('customer'));
    }

    /**
     * Display a listing of the assessments results for this customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function resultsIndex()
    {
        if (!session('customer_id') || session('customer_auth') !== true) {
            return view('frontend.customer.login');
        }
        $customer = Customer::findOrFail(session('customer_id'));

        $assessments = Assessment::with('respondent')
            ->whereHas('respondent', function($query ) use ($customer) {
                $query->where('membercode_id', '=', $customer->membercode->id);
            })
            ->get();

        return view('frontend.customer.index', compact('assessments'));
    }

    /**
     * Display the answers details page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resultsAnswers($id)
    {
        if (!session('customer_id') || session('customer_auth') !== true) {
            return view('frontend.customer.login');
        }
        $customer = Customer::findOrFail(session('customer_id'));

        $assessment = Assessment::findOrFail($id);
        if ($assessment->respondent->membercode_id != $customer->membercode->id) {
            return view('frontend.home');
        }

        $answers = AssessmentAnswer::where('assessment_id', $id)
            ->with(['question' => function($query) {
                $query->orderBy('number', 'asc');
            }])
            ->get();

        // Check if assessment is complete with all answers
        if ($assessment->is_incomplete) {
            $error_msg = 'ERROR: The selected assessment is incomplete. Please contact system administrator for more information.';

            return view('frontend.customer.answers', compact('assessment', 'answers'))
                ->withErrors([$error_msg]);
        }

        return view('frontend.customer.answers', compact('assessment', 'answers'));
    }

    /**
     * Display the assessment evaluation page, with score and graph.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resultsScore($id)
    {
        if (!session('customer_id') || session('customer_auth') !== true) {
            return view('frontend.customer.login');
        }
        $customer = Customer::findOrFail(session('customer_id'));

        $assessment = Assessment::findOrFail($id);
        if ($assessment->respondent->membercode_id != $customer->membercode->id) {
            return view('frontend.home');
        }

        // Check if assessment is complete with all answers
        if ($assessment->is_incomplete) {
            $error_msg = 'ERROR: The selected assessment is incomplete. Please contact system administrator for more information.';

            return back()->withErrors([$error_msg]);
        }

        $score  = AssessmentScore::where('assessment_id', $id)->get();
        $result = AssessmentResult::where('assessment_id', $id)->first();

        // Evaluate assessment, calculate score and create graph/chart image
        if (!count($score) || !isset($result)) {
            $data = [];
            foreach ($assessment->assessments_answers as $answer) {
                $data[$answer->question_id] = $answer->answer->answer;
            }

            $evaluatorService = new AssessmentEvaluator();
            $html_content = $evaluatorService->evaluate($id, $data, $assessment->respondent->gender, $assessment->respondent->adult);

            // Store results evaluation in html format
            AssessmentResult::create([
                'assessment_id' => $id,
                'content'       => $html_content
            ]);

            // Create score graph image
            $score = AssessmentScore::where('assessment_id', $id)->get();
            $traitData = [];
            foreach ($score as $trait_score) {
                $traitData[$trait_score->trait->key] = $trait_score->score;
            }
            $chart = \App\Services\ChartBuilder::buildChartImage($traitData);

            // Store image on file server
            $chart_hash = substr(md5($id), 0, 16);
            $filename = 'images/score-charts/'. $chart_hash .'.png';
            $fp = fopen($filename, 'w');
            imagepng($chart, $fp);

        } else {
            // Load existing results from database object
            $html_content = $result->content;
        }

        return view('frontend.customer.score', compact('assessment', 'score', 'html_content'));
    }

}
