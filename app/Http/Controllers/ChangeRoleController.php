<?php

namespace App\Http\Controllers;

use Auth;
use App\role;
use Illuminate\Http\Request;

class ChangeRoleController extends Controller
{
    public function open_request_form()
    {
    	$name = Auth::user()->name;
    	$email = Auth::user()->email;
    	$roles = role::all();
    	$role_of_user = Auth::user()->role()->first()->name;
    	return view('layouts.RequestForm',compact('name','email','role_of_user','roles'));
    }
}
