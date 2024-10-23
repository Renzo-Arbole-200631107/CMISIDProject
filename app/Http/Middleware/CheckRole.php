<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next, $role): Response
    {
        
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login
        }
        

        // Check if the user has the required role
        if (!Auth::user()->hasAnyRole(['project manager', 'developer'])) {
            return redirect()->route('projects.index')->with('error', 'You do not have access to this resource.');
        }

        return $next($request);
    }
}