<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function resetPassword(User $user){
        //dd('helo');

        $defaultPass = 'cmisid';
        $user->update([
            'password' => Hash::make($defaultPass),
        ]);

        $user->password_changed = false;
        $user->save();
        return redirect()->route('users.index')->with('success', 'Password has been reset to default.');
    }
}
