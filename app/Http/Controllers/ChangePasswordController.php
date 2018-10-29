<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{

     public function open_change_password_form()
    {
       return view('layouts.ChangePassword')->with('error','');
    }

    public function change_password(Request $request)
    {
        $error = 'Old password is not correct';
        $auth_userId = Auth::user()->id;
        $stored_password = User::where('id',$auth_userId)->first()->password;
        $entered_old_password = $request->old_password;
        if (password_verify($entered_old_password, $stored_password)) 
        {
          if($request->new_password == $request->new_confirm_password)
          {
              $new_password = Hash::make($request->new_password);
              User::where('id',$auth_userId)->update(['password' => $new_password]);
              
              return back()->with('success','*Password changed succefully');
          }
          else
          {
            return redirect()->back()->with('confirm_error','*Confirm Password not matched');
          }
        }
        else
        {
          
          return redirect()->back()->with('old_error','*Old password is incorrect');
  
        }
    }  
       
}
