<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Subject;
use Illuminate\Http\Request;

class TopicsController extends Controller
{


    public function addtopic(Request $request)
    {
        $formInput = $this->validate($request,[
            'newtopic'=> 'required',
            'sub'=>'required'
        ]);
        // dd(Topic::where('topic','=',request('newtopic'))->first());
        
        if(Topic::where('topic','=',request('newtopic'))->exists() && Subject::find(request('sub'))->topics->contains(Topic::where('topic','=',request('newtopic'))->first()->id)){
            return response()->json(array("msg","already added"),200);
        }
        else if(! Topic::where('topic','=',request('newtopic'))->exists()){
            $topic=Topic::Create([
                'topic'=> request('newtopic')
            ]);
            $topic->save();
            Subject::find(request('sub'))->topics()->attach($topic->id);
            return response()->json(array("msg","success"),200);
        }
        else{
            Subject::find(request('sub'))->topics()->attach(Topic::where('topic','=',request('newtopic'))->first()->id);
            return response()->json(array("msg","attached"),200);
        }
    }

    public function activatetopic(Request $request)
    {
        $subject=array();
        $questions= Topic::find($request->topic)->questions;
        foreach($questions as $que){
           $que->choices = json_decode($que->choices);     
        }
        $topic=Topic::find($request->topic)->topic;
        $sub=Topic::find($request->topic)->subjects()->get();
        foreach($sub as $s)
            array_push($subject,$s->subject);
        return response()->json(array("msg",$questions,$topic,$subject),200);
    }


    
}
