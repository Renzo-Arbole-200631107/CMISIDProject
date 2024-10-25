<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo(){
        $user = Auth::user();
        
        if($user->hasRole('project manager')){
            return 'projects/';
        } elseif($user->hasRole('developer')){
            return 'users/';
        } else{
            return '/';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect($this->redirectTo());
        }
    
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
}
