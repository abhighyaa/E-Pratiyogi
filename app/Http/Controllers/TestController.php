<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
    public function createtest(){

        $t=Test::Create([
            'test'=> request('test')
        ]);
        $t->save();
        $t->users()->attach(auth()->user()->id);
        return;
    }

    public function gettests()
    {
        $tests=auth()->user()->tests()->get();
        return response()->json($tests);
    }
     
    
}
