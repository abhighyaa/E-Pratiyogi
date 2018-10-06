<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
        $this->middleware('admin');
      }
        public function index()
      {
        $tags=Tag::getTags();
        return view('backend.library',compact('tags'));
      }
}
