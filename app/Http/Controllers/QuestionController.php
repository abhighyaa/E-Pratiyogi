<?php

namespace App\Http\Controllers;

use App\Coding;
use App\Question;
use App\Topic;
use App\Subject;
use App\Category;
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
        public function getquestions(Category $cat,Subject $sub)
        {
            $questions=array();
            $que=$sub->questions()->get();
            
            foreach($que as $q){
                if($q->categories()->where('id',$cat->id)->exists()&&$q->users()->where('id',auth()->user()->id)->exists()){
                    $q->choices=json_decode($q->choices);
                    array_push($questions,$q);
                }
            }
            return response()->json($questions);
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

    public function savequestion(Request $request)
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
        $s = Subject::where('subject','=',request('subject'))->first();
        $c = Category::where('category','=',request('category'))->first();
        $q->subjects()->attach($s->id);
        $q->categories()->attach($c->id);
        $q->users()->attach(auth()->user()->id);
        return;
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

    public function getequestion(Question $q)
    {  
        $q->choices = json_decode($q->choices);
        return response()->json($q);
    }

    public function getecquestion(Coding $q)
    {  
        return response()->json($q);
    }

    public function deletequestion(Question $q)
    {  
        $q->delete();
        return;
    }

    public function deletecoding(Coding $q)
    {  
        $q->delete();
        return;
    }

    public function editquestion(Request $request)
    {
        $q=Question::find($request->id);
        $q->question= $request->question;
        $q->answer=$request->answer;
        $q->choices=json_encode($request->choices);
        $q->save();
        return;
    }
    public function editcquestion(Request $request)
    {
        $q=Coding::find($request->id);
        $q->question= $request->question;
        $q->tc1=$request->tc1;
        $q->op1=$request->op1;
        $q->tc2=$request->tc2;
        $q->op2=$request->op2;
        $q->tc3=$request->tc3;
        $q->op3=$request->op3;
        // $q->choices=json_encode($request->choices);
        $q->save();
        return;
    }
    // public function editques(Request $request){
    //     $id=request('ques');
    //     // dd($id);
    //     $question=Question::find($id);
    //     $subjects=$question->subjects;
    //     $topics=$question->topics;
       
    //     $question->choices = json_decode($question->choices);     
        
    //     return response()->json(array("msg",$question,$subjects,$topics),200);
        

    // } 
}
