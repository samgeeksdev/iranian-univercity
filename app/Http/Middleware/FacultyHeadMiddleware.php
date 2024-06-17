<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FacultyHeadMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            Log::info('User is authenticated', ['user' => Auth::user()]);
            if (Auth::user()->role == 'faculty_head' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role == 'admin') {
                Log::info('User has the correct role', ['role' => Auth::user()->role]);
                return $next($request);
            } else {
                Log::warning('User does not have the correct role', ['role' => Auth::user()->role]);
            }
        } else {
            Log::warning('User is not authenticated');
        }

        return redirect()->route('dashboard')->with('error', 'Access Denied');
    }
}