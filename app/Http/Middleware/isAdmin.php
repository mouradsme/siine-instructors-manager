<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        // Check if the current user is authenticated and is an admin
        if (Auth::check() && Auth::user()->role == 1) {
            // User is an admin, allow the request to proceed
            return $next($request);
        }

        // User is not an admin, redirect them or return an error response
        // For example, redirecting to the home page with an error message
        return redirect()->route('dashboard')->with('error', 'You do not have permission to access this resource.');
    }
}
