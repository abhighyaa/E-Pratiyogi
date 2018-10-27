<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     protected function sendLoginResponse(Request $request)
     {
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);
            $user = User::where('email',$request->email)->first();

            if($user->role->first()->name == 'student')
                return redirect('/');
            elseif($user->role->first()->name == 'teacher')
                return redirect('/teacher/home');
            elseif($user->role->first()->name == 'admin')
                return redirect('/admin/dashboard');
    }
   
    protected function guard()
    {
        return Auth::guard();
    }
}
