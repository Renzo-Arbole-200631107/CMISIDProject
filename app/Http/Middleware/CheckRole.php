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
        if(!Auth::check()){
            return redirect()->route('login');
        };

        $account = Auth::user();

        if($account->is_admin !== 0){
            abort(403, 'Unauthorized access.');
        }

        if($account->is_admin !== 1){
             abort(403, 'Unauthorized access.'); 
        }
        return $next($request);
    }
}
