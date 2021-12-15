<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessNotification;
use App\Models\User;
use App\Notifications\OffenderNotification;
use Illuminate\Support\Facades\Notification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $users = User::permission('offender payment notification')->get();
        // return $users;
        $permisions = Permission::orderBy('id', 'desc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $myrole = Auth::user()->getRoleNames()[0];
        $authrole = Role::findByName($myrole);

        return view('users.permission.index', compact(['permisions','authrole', 'roles']));

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
         // return $request->all();
         $role = Role::findByName($request->role);
         // return $role;
          $role->givePermissionTo($request->permission);
          $icon = "fa fa-thumbs-up";
          $message ='You assigned  '. $request->permission. ' to '. $request->role ;

        //   dispatch(new ProcessNotification($icon,$message));
        Notification::send(Auth::user(), new OffenderNotification($icon, $message ));

        //   ProcessNotification::dispatch($icon, $message);
        return ucfirst($request->role)." added ". $request->permission." permission";
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
          // return $request->all();
          $role = Role::findByName($request->role);
          // return $role;
           $role->givePermissionTo($request->permission);
           $icon = "fa fa-thumbs-up";
           $message = 'You assigned  '. $request->permission. ' to '. $request->role;
           Notification::send(Auth::user(), new OffenderNotification($icon, $message ));
        // dispatch(new ProcessNotification());

          return ucfirst($request->role)." added ". $request->permission." permission";

    }

    public function removepermission(Request $request){
        $role = Role::findByName($request->role);
        $role->revokePermissionTo($request->permission);
        $icon = "fa fa-thumbs-down";
        $message = 'You withdraw '. $request->permission. ' from '. $request->role;
        Notification::send(Auth::user(), new OffenderNotification($icon, $message));
        // dispatch(new ProcessNotification());

        // $this->dispatch(new ProcessNotification($icon, $message));
        // ProcessNotification::dispatch($icon, $message);
        // Notification::send(Auth::user(), new OffenderNotification($icon, $message))


        // Notification::send(Auth::user(), new OffenderNotification($icon,  ));

        return  ucfirst($request->permission)." permission withdraw from " .ucfirst($request->role);

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
