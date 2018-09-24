<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Topic;
use App\Subject;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $subjects=Subject::all();
        return view('backend.library',compact('subjects'));
    }

    public function getsubjects()
    {
        $subjects=Subject::with('Questions')->get();
        return response()->json($subjects);
        // return view('backend.library',compact('subjects'));
    }

    public function subj(Subject $subject)
    {
        $questions = Subject::find($subject->id)->questions;
        $topics = Subject::find($subject->id)->topics;
        
        return view('backend.showquestions',compact('subject','questions','topics'));
    }

    public function addsubject(Request $request)
    {
        $input = $this->validate($request,[
            'newsubject'=> 'required'
        ]);
        if(Subject::where('subject','=',request('newsubject'))->exists()){
            return response()->json(array("msg","already added"),200);
        }
        $subject=Subject::Create([
            'subject'=> request('newsubject')
        ]);
        $subject->save();
        return response()->json(array("msg","added succesfully"),200);
    }

    public function delsubject(Subject $subject)
    {
        $subject=Subject::find($subject->id);
        if(Subject::where('id','=',$subject->id)->exists()){
            $subject->delete();
            return response()->json(array("msg","deleted"),200);
        }
        return response()->json(array("msg","try later"),200);
    }
}
