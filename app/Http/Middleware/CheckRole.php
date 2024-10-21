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
    
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        if(!$user){
            return redirect()->route('login');
        }

        if($user->is_admin === 0){
            if($request->isMethod('get')||$request->isMethod('put')){
                return $next($request);
            }
            abort(403, 'Access denied.');
        }

        if($user->is_admin === 1){
            return $next($request);
        }
        abort(403, 'Insufficient permissions.'); 
        
    }
        
}
