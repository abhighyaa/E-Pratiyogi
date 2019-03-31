<?php

namespace App\Http\Controllers;
use App\Test;
use App\Attempt;
use App\Result;
use Illuminate\Http\Request;
use DB;
use Session;

class TeacherTestController extends Controller
{
    // public function play(){
    //     $test=Test::findOrFail(1);
    //     $questions = $test->questions;
    //     $ques=[]; 
    //     $cntr = 0;
    //     foreach($questions as $question) {
    //         $ques[$cntr++]=$question;
    //       }
    //       shuffle($ques);
    //     return view('teachertest',compact('test','ques')); 
 
    // }

    public function info(Request $request){
        
        request()->validate([
          'email' => 'required|email',
        'firstname' => 'required|string|max:50',
        'lastname' => 'required',
         'securityques' => 'required',
         'securityanswer' => 'required'
         ]);
         

         $a = Attempt::Create(
            ['email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'securityques' => $request->securityques,
            'securityanswer' => $request->securityanswer]
                    );
        $test=Test::findOrFail(1);  // replace
        $test->attempts()->attach($a);
        $email = $request->email;
        $questions = $test->questions;
        $ques=[]; 
        $cntr = 0;
        foreach($questions as $question) {
            $ques[$cntr++]=$question;
          }
          shuffle($ques);

        return view('teachertest',compact('test','ques','email')); 
    }


    public function saveattempt(Request $request){
     //   $test=$request->test;
        $serialized_array = serialize($request->attempt);
        $id=$request->id;
        $test=Test::findOrFail($id);    
        $t=$test->attempts->where('email',$request->email)->first();
        $t->attempt = $serialized_array;   
        $t->min = $request->min;
        $t->sec = $request->sec;
        $t->save();
      
        // DB::table('attempt')->where('email',$request->email)->update(
        //     ['attempt' => $serialized_array ,
        //     'min' => $request->min,
        //     'sec' => $request->sec]
        //      );
        return $request->all();         //timepass

    }

    public function savetime(Request $request){
        $id=$request->id;
        $test=Test::findOrFail($id);    
        $t=$test->attempts->where('email',$request->email)->first();
         
        $t->min = $request->min;
        $t->sec = $request->sec;
        $t->save();
      
        // DB::table('attempt')->where('email',$request->email)->update(
        //     ['min' => $request->min,
        //     'sec' => $request->sec]
        //      );
        return $request->all();         //timepass

    }

    public function savest_at(Request $request){
        $id=$request->id;
        $test=Test::findOrFail($id);    
        $t=$test->attempts->where('email',$request->email)->first();
        $review = serialize($request->review);
        $status = serialize($request->status);
        $t->min = $request->min;
        $t->sec = $request->sec;
        $t->review = $review;
        $t->status = $status;
        $t->save();
      
        // DB::table('attempt')->where('email',$request->email)->update(
        //     ['min' => $request->min,
        //     'sec' => $request->sec,
        //     'review' => $review,
        //     'status' => $status,
        //     ]
        //      );
        return $request->all();         //timepass

    }


 
    public function continuetestdetails(Request $request){
        $test=Test::findOrFail(1);  
        $x=$test->attempts->where('email',$request->email)->first();  
        //$x =DB::table('attempt')->where('email',$request->email)->first();
        if($x == null){
            Session::flash('message', 'NO USER WITH THIS EMAIL!'); 
            Session::flash('alert-class', 'alert-danger'); 
            return view('continuetest');

        }
        else{
           if($request->securityques == $x->securityques && $request->securityanswer == $x->securityanswer){
            $status = unserialize($x->status);
            $review = unserialize($x->review);
            $questions =unserialize($x->questions);
            $attempt =unserialize($x->attempt);
            $min = $x->min;
            $sec = $x->sec;
            $email = $x->email; 
        
            return view('attemptedtest',compact('status','review','questions','attempt','min','sec','email','test'));   
           } 
           else{
            Session::flash('message', 'WRONG SECURITY INFORMATION'); 
            Session::flash('alert-class', 'alert-danger');  
            return view('continuetest');  
           }
        }
        
    }

    public function savequestionss(Request $request){
        $id=$request->id;
        $test=Test::findOrFail($id);    
        $t=$test->attempts->where('email',$request->email)->first();
        $serialized_array = serialize($request->ques);
        
        $t->questions = $serialized_array;
        $t->save();
        // DB::table('attempt')->where('email',$request->email)->update(
        //     ['questions' =>$serialized_array]
        //      );
             return $request->all();         //timepass

    }


    public function saveresults(Request $request){
        $id=$request->id;
        $test=Test::findOrFail($id);    
        $x=$test->attempts->where('email',$request->email)->first();
        $r = Result::Create(
            ['email' => $request->email,
            'firstname' => $x->firstname,
            'lastname' => $x->lastname,
            'attempt'=> $x->attempt,
            'questions'=>$x->questions,
            'result' => $request->per]);
       $test->results()->attach($r);
       $x->delete(); 
        return $request->all();
    }

    public function results($id,$email){
        $test=Test::findOrFail($id);    
        $x=$test->results->where('email',$email)->first();
        $result = $x->result;
        return view('results',compact('result'));   
    }
    
}
