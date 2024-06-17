<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role == 'faculty_head' || Auth::user()->role == 'professor')) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Access Denied');
    }
}