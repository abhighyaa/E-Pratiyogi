<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\NewUserRegistration;
use Notification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/student/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $admin = User::whereHas('role', function($q) {
            $q->where('role_id', 1);                 
          })->with('role')->first();
        
          $title = "New Registration";
          $body  = "A new account has been registered with the name <b>$user->name</b> and 
                    following email address <b>$user->email</b>.";

          $welcomeLetter = collect([
            'title' => $title,
            'body' =>  $body 
         ]);

          Notification::send($admin,new NewUserRegistration($welcomeLetter));

          $title = 'Dear ';
          $body = 'Thank you for your registration. You have sucsessfully registered. We have received your registration.
                     For any query, feel free to contact.';
            $welcomeLetter = collect([
            'title' => $title,
            'body' =>  $body 
            ]);

          Notification::send($user,new NewUserRegistration($welcomeLetter));
        return $user;
    }
}
