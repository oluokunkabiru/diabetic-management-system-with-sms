<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Please login');
        }
        if (Auth::user()->role =='staff') {
            return redirect()->route('staffdashboard');
        }
        if (Auth::user()->role == 'patient') {
            return redirect()->route('patientdashboard');

        }
    }
}
