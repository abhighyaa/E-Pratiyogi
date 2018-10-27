<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Question;

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

    public function gettestdetails(Test $t)
    {
        $questions=$t->questions()->get();
        foreach($questions as $q){
            $q->choices=json_decode($q->choices);
        }
        return response()->json(array($questions,$t->test));
    }
     
    public function savequetotest(Request $request)
    {
        if(request('type')!='fub'){
            $ch=array();
            for($i=0;$i<count($request->choices);$i++){
                $ch[$i]=$request->choices[$i];
            }
            $ch =json_encode($request->choices);
        }
        if(request('answer')==null){
            $q=Question::Create([
                'question'=> request('question'),
                'answer'=> $request->choices[0],   
                'complexity'=>request('complexity'),
                'choices'=>$ch
            ]);
        }
        else{
            if(request('type')=='check'){
                $ans=array();
                for($i=0;$i<count($request->answer);$i++){
                    $ans[$i]=$request->answer[$i];
                }
                $ans =json_encode($ans); 
            }
            else{
                $ans=request('answer');
            }
            if(request('type')=='fub'){
                $ch=null;
            }
            $q=Question::Create([
                'question'=> request('question'),
                'type'=>request('type'),
                'answer'=> $ans,   
                'complexity'=>request('complexity'),
                'choices'=>$ch
            ]);
        }
        $q->save();
        $t = Test::where('test','=',request('test'))->first();
        $q->tests()->sync([$t->id => ['marks' => 1]]);
        return;
    }
   
    public function deletetest(Test $test)
    {
        $test->delete();
        return;
    }
}
