<?php

// use App\Models\Configuration;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

if(! function_exists('appSettings')){
        function appSettings(){
            $config = Setting::first();
        return $config;
    }

    if(! function_exists('myrole')){
        function myrole(){
            $roles = Auth::user()->getRoleNames()[0];
            $role = Role::findByName($roles);
            return $role;

    }
}


}

?>
