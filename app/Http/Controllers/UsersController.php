<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('id', 'desc')->get();
        $roles = Role::get();
        return view('users.manage-users', compact(['users', 'roles']));
    }

    public function disables($id){
        $user = User::where('id', $id)->first();
        $user->status = "disabled";
        $user->update();
        return redirect()->back()->with('delete', $user->name .' disabled successfully');


     }

     public function enable($id){
        $user = User::where('id', $id)->first();
        $user->status = "active";
        $user->update();
        return redirect()->back()->with('success', $user->name .' enabled successfully');

     }

    public function readNotification($id){
        // return $id;
        $userUnreadNotification= auth()->user()->notifications->find($id);
        // return $userUnreadNotification;
        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }

    }
    public function readAllNotification(){
        $notification = auth()->user()->unreadNotifications;
        // return $notification;
        if($notification) {
            $notification->markAsRead();
        }
        return redirect()->back();

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
