<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Category;
use App\Models\Question;
use App\Notifications\DoctorNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::orderBy('id', 'desc')->get();
        $questions = Question::orderBy('id', 'desc')->with(['category', 'user'])->get();
        return view('users.question-bank.index', compact(['questions', 'category']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        //
        $question = new Question();
        $question->question = $request->question;
        $question->type = $request->type;
        $question->category_id = $request->category;
        $question->user_id = Auth::user()->id;
        $question->save();
        $icon = "fa fa-question";
        $message = "Question added by ". Auth::user()->name;
        $url ="#";
        $title = "Question";
        Notification::send(Auth::user(), new DoctorNotification($icon, $message, $title, $url));

        return redirect()->back()->with('success', 'Question added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $question = Question::where('id', $id)->first();
        $question->question = $request->question;
        $question->type = $request->type;
        $question->category_id = $request->category;
        $question->user_id = Auth::user()->id;
        $question->update();
        $icon = "fa fa-question";
        $message = "Question updated by ". Auth::user()->name;
        $url ="#";
        $title = "Question";
        Notification::send(Auth::user(), new DoctorNotification($icon, $message, $title, $url));

        return redirect()->back()->with('success', 'Question updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($question)
    {
        //
        //  return $question;
         $zone = Question::where('id', $question)->first();
        //  return $zone;
         $zone->forceDelete();
         $icon = "fa fa-trash";
         $message = "Question deleted by ". Auth::user()->name;
         $url ="#";
         $title = "Question";
         Notification::send(Auth::user(), new DoctorNotification($icon, $message, $title, $url));
         return redirect()->back()->with('delete', 'Question deleted successfully');

    }
}
