<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\AssessmentEvaluator;

use App\Assessment;
use App\AssessmentAnswer;
use App\AssessmentResult;
use App\AssessmentScore;
use App\Respondent;

class AssessmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assessments = Assessment::paginate(50);
        // dd($assessments);
        return view('admin.assessments.index', compact('assessments'));
    }

    /**
     * Display the answers details page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function answers($id)
    {
        $assessment = Assessment::findOrFail($id);
        $answers = AssessmentAnswer::where('assessment_id', $id)
            ->with(['question' => function($query) {
                $query->orderBy('number', 'asc');
            }])
            ->get();

        // Check if assessment is complete with all answers
        if ($assessment->is_incomplete) {
            $error_msg = 'ERROR: Cannot calculate results! The assessment # '. $id .' is incomplete, '
                . (config('assessment.questions_number', 210) - count($assessment->assessments_answers))
                .' answers are missing.';

            return view('admin.assessments.answers', compact('assessment', 'answers'))
                ->withErrors([$error_msg]);
        }

        return view('admin.assessments.answers', compact('assessment', 'answers'));
    }

    /**
     * Display the assessment evaluation page, with score and graph.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function score($id)
    {
//FIXME: un-comment when required to re-generate results/score
//AssessmentScore::where('assessment_id', $id)->delete();
//AssessmentResult::where('assessment_id', $id)->delete();
//END
        $assessment = Assessment::findOrFail($id);

        // Check if assessment is complete with all answers
        if ($assessment->is_incomplete) {
            return redirect()->route('admin.assessments.answers', [$id]);
        }

        // Get Assessment results if already calculated
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

        return view('admin.assessments.score', compact('assessment', 'score', 'html_content'));
    }
}
