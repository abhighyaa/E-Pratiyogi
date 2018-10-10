<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Topic;
use App\Subject;
use App\Instruction;
use Requests;

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


    public function fetchSubjects()
    {
         $subjects = Subject::all();
         return response()->json($subjects);
    }

    public function remove(Request $request){
        Subject::where('id',$request->id)->delete();
        $subject = Subject::all();
        return $subject;
    }

    public function CreateSubject(Request $request){
        if($request->name == 'null')
        {
            return 'Empty subject name can not be added';
        }
        else{
            Subject::create(['subject' => $request->name]);
            $subject = Subject::all();
            return $subject;
        }
    }

    public function fetchInstructions(Request $request)
    {
        $instructions = Instruction::where('subject_id',$request->id)->get();
        return response()->json($instructions);
     }
     public function update(Request $request){
       Subject::where('id',$request->id)->update(['subject' => $request->subject]);
       $subjects = Subject::all();
       return response()->json($subjects);
    }
 }
 