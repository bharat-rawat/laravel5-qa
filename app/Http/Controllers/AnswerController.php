<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct()
    {
        //$this->middleware('Auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question,Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);
        $data = $request->all();
        $data['user_id'] =\Auth::id();
        $question->answers()->create($data);
        //$question->answers()->create(['body'=>$request->body,'user_id'=>\Auth::id()]);
        return back()->with('success','Your answer is submitted successfully!');
    
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);
        return view('answers.edit',compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $request->validate([
            'body'=>'required',
        ]);
        $answer->update($request->all());
        return redirect()->route('question.show',$question->id)->with('success','Answer update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete',$answer);
    
        $answer->delete();
        return back()->with('success','Your answer is deleted');
    }
}
