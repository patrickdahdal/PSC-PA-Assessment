<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Answer;
use App\Question;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('number')->get();

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Display a listing of the Answers.
     *
     * @return \Illuminate\Http\Response
     */
    public function answersIndex()
    {
        $answers = Answer::orderBy('number')->get();

        return view('admin.questions.answers_index', compact('answers'));
    }
}
