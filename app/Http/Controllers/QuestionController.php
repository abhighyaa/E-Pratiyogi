<?php

namespace App\Http\Controllers;

use App\Question;
use App\Topic;
use App\Subject;
use App\Tag;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
        $this->middleware('auth'); 
        $this->middleware('teacher');
      }
      
    // public function index()
    // {
    //     $this->middleware('auth');
    // }
        public function index()
        {
            // $tags = Tag::all();
            return view('backend.library');
        }
    public function addquestions(Request $request){
        $input = $this->validate($request,[
            'newquestion'=> 'required',
            'newanswer'=>'required',
            'choice1'=>'required',
            'choice2'=>'required',
            'complexity'=>'required',
            'subject'=>'required',
            'topic'=>'required'
        ]);
         $choices = new \stdclass();
         $choices->choice1 = request('choice1');
         $choices->choice2 = request('choice2');
        $c[0]=request('choice1');
            $c[1]=request('choice2');
          //  $ch = '{"a":"'.$c[0].'","b":"'.$c[1].'"}'; 
          $ch['0'] = $c[0];
          $ch['1'] = $c[0];  
          $ch_et =json_encode($choices);
        $s = Subject::where('subject','=',request('subject'))->first();
        $t = Topic::where('topic','=',request('topic'))->first();
        
        if($s=="null"|| $t=="null"){
            return response()->json(array("msg","error"),200);
        }
        
        $q=Question::Create([
            'question'=> request('newquestion'),
            'answer'=> request('newanswer'),
            'complexity'=>request('complexity'),
            'choices'=>$ch_et
        ]);

        $q->save();
        $q->subjects()->attach($s->id);
        $q->topics()->attach($t->id);
        // $q->subjects()->attach($s->id);
        // $q->topics()->attach($t->id);
        return response()->json(array("msg","success"),200);


    } 

    public function savequestions(Request $request){
        $count=0;
        $input = $this->validate($request,[
            'id'=>'required',
            'question'=> 'required',
            'answer'=>'required',
            'choices'=>'required',
            'complexity'=>'required',
            'subjects'=>'required',
            'topics'=>'required'
        ]);
        // dd($request->choices['choice1']);
            // $c[0]=request('choice1');
            // $c[1]=request('choice2');
            // $ch='{"a":"'.$c[0].'","b":"'.$c[1].'"}';
            // d(request('choices'));
        //     $ch=[];
            // foreach(request('choices') as $c){
            //     $ch[$count]=$c;
            //     $count++;
            // }
        //    json_encode($ch);
           
            // foreach(request('subjects') as $subject){
                
            // }
        // $s = Subject::where('subject','=',request('subject'))->first();
        // $t = Topic::where('topic','=',request('topic'))->first();
        
        // if($s=="null"|| $t=="null"){
        //     return response()->json(array("msg","error"),200);
        // }
        $choices = new \stdclass();
        $choices->choice1 = $request->choices['choice1'];
        $choices->choice2 = $request->choices['choice2'];
        // dd($request->choices);
        $q=Question::find($request->id);
            $q->question= $request->question;
            $q->answer=$request->answer;
            $q->complexity=$request->complexity;
            $q->choices=json_encode($choices);
        
        $q->save();
        // $q->subjects()->attach($s->id);
        // $q->topics()->attach($t->id);
        // $q->subjects()->attach($s->id);
        // $q->topics()->attach($t->id);
        return response()->json(array("msg","success"),200);
        

    } 

    public function editques(Request $request){
        $id=request('ques');
        // dd($id);
        $question=Question::find($id);
        $subjects=$question->subjects;
        $topics=$question->topics;
       
        $question->choices = json_decode($question->choices);     
        
        return response()->json(array("msg",$question,$subjects,$topics),200);
        

    } 
}
