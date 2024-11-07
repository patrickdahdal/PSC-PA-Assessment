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
    public function create()
    {
        return view('admin.questions.create');
    
    }
   
    public function store(Request $request)
    {
        $data = $request->all();
        Question::create($data);
        return redirect()->route('admin.questions.index')->with('success', 'Create Question successfully.');
    }
    
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        $question->update($request->all());
        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy($id)
    {
        $question = Question::find($id)->delete();
        
        return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully.');
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
