<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Notifications\DoctorNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CategoryController extends Controller
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
        return view('users.category.index', compact(['category']));
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
    public function store(CategoryRequest $request)
    {
        //
        $center = new Category();
        $center->name = $request->center;
        $center->user_id = Auth::user()->id;
        $icon = "fa fa-house";
        $message = "New category added by ". Auth::user()->name;
        $url ="#";
        $title = "Training center";
        Notification::send(Auth::user(), new DoctorNotification($icon, $message, $title, $url));
        $center->save();
        return redirect()->back()->with('success', 'New Category point added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //
        $center = Category::where('id', $id)->first();
        $center->name = $request->center;
        $center->update();
        $icon = "fa fa-wpbeginner";
        $message = "Category update by ". Auth::user()->name;
        $url ="#";
        $title = "Pick up";
        Notification::send(Auth::user(), new DoctorNotification($icon, $message, $title, $url));
        return redirect()->back()->with('success', 'Category update successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // return $category;
        $zone = Category::where('id', $id)->first();
        // return $zone;
        $zone->forceDelete();
        $icon = "fa fa-minus";
        $message = "Pick up point deleted by ". Auth::user()->name;
        $url ="#";
        $title = "Pick up point";
        Notification::send(Auth::user(), new DoctorNotification($icon, $message, $title, $url));
        return redirect()->back()->with('delete', 'Pick up station deleted successfully');

    }
}
