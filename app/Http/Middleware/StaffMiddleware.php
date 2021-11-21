<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Please login');
        }
        if (Auth::user()->role =='patient') {
            return redirect()->route('patientdashboard');
        }
        if (Auth::user()->role == 'staff') {
            return $next($request);
        }
    }
}
