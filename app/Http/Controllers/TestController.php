<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Student;
use App\Question;
use App\Coding;

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
        $coding=$t->codings()->get();
        return response()->json(array($questions,$t->test,$coding));
    }
     
    public function savequetotest(Request $request)
    {
        if(request('type')!="coding"){
            if(request('type')=='mcq'){
                $ch=array();
                for($i=0;$i<count($request->choices);$i++){
                    $ch[$i]=$request->choices[$i];
                }
                $ch =json_encode($request->choices);
            }
            if(request('answer')==null && request('type')=='mcq'){
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
        }
        else{
            $q=Coding::Create([
                    'question'=> request('question'),
                    'tc1'=>request('tc1'),
                    'op1'=>request('op1'),
                    'tc2'=>request('tc2'),
                    'op2'=>request('op2'),
                    'tc3'=>request('tc3'),
                    'op3'=>request('op3'),
                    'complexity'=>request('complexity')
            ]);
            $q->save();
            $t = Test::where('test','=',request('test'))->first();
            $q->tests()->sync($t->id);
            return;
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

    public function distributetest(Test $test)
    {
        $url = 'http://127.0.0.1:8000/teacher/test/'.$test->id;
        return response($url,200);
    }

   

    public function getoutput(Request $request)
    {
       $count=-1;
       $c = Coding::find($request->id);
       if($request->lang=='c'){
            $CC="gcc";
            $out="timeout 5s ./a.out";
            $code=$request->code;
            $input1=$c->tc1;
            $input2=$c->tc2;
            $input3=$c->tc3;
            $filename_code="main.c";
            $filename_in="input.txt";
            $filename_error="error.txt";
            $executable="a.out";
            $command=$CC." -lm ".$filename_code;	
            $command_error=$command." 2>".$filename_error;
            $check=100;
            $file_code=fopen($filename_code,"w+");
            fwrite($file_code,$code);
            fclose($file_code);
            $file_in=fopen($filename_in,"w+");
            fwrite($file_in,$input1);
            fclose($file_in);
            exec("chmod 777 $executable"); 
            exec("chmod 777 $filename_error");
            shell_exec($command_error);
            $error=file_get_contents($filename_error);
            $executionStartTime = microtime(true);
            if(trim($error)=="")
            {
                if(trim($input1)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                if($output==$c->op1){
                    $check=0;
                }
                //echo "<pre>$output</pre>";
                // echo "<textarea disabled id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">Required out:$c->op1\nActual out:$output</textarea><br><br>";
            }
            else if(!strpos($error,"error"))
            {
                echo "<pre>$error</pre>";
                if(trim($input1)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                // echo "<pre>$output</pre>";
                // echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
                        if($output==$c->op1){
                            $check=0;
                        }
            }
            else
            {
                echo "<pre>$error</pre>";
                $check=1;
            }
            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - $executionStartTime;
            $seconds = sprintf('%0.2f', $seconds);
            if($check==1)
            {
                $res[1]=2;
                echo "<pre>Verdict : CE</pre>";
                return;
            }
            else if($check==0 && $seconds>3)
            {
                $res[1]=3;
                echo "<pre>Verdict : TLE</pre>";
                return;
            }
            else if($check==0)
            {
                //accepted
                $res[1]=0;
                // echo "<pre>Verdict : AC</pre>";
            }
            else
            {
                //wrong answer
                $res[1]=1;
                // echo "<pre>Verdict : WA</pre>";
            }

            $file_in=fopen($filename_in,"w+");
            fwrite($file_in,$input2);
            fclose($file_in);
            $check=100;
            exec("chmod 777 $executable"); 
            exec("chmod 777 $filename_error");
            shell_exec($command_error);
            $error=file_get_contents($filename_error);
            $executionStartTime = microtime(true);
            if(trim($error)=="")
            {
                if(trim($input2)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                if($output==$c->op2){
                    $check=0;
                }
                //echo "<pre>$output</pre>";
                // echo "<textarea disabled id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">Required out:$c->op2\nActual out:$output</textarea><br><br>";
            }
            else if(!strpos($error,"error"))
            {
                echo "<pre>$error</pre>";
                if(trim($input2)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                // echo "<pre>$output</pre>";
                // echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
                        if($output==$c->op2){
                            $check=0;
                        }
            }
            else
            {
                echo "<pre>$error</pre>";
                $check=1;
            }
            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - $executionStartTime;
            $seconds = sprintf('%0.2f', $seconds);
            if($check==1)
            {
                echo "<pre>Verdict : CE</pre>";
                $res[2]=2;
                return;
            }
            else if($check==0 && $seconds>3)
            {
                $res[2]=3;
                echo "<pre>Verdict : TLE</pre>";
                return;
            }
            else if($check==0)
            {
                //accepted
                $res[2]=0;
                // echo "<pre>Verdict : AC</pre>";
            }
            else
            {
                //wrong answer
                $res[2]=1;
                // echo "<pre>Verdict : WA</pre>";
            }

            $file_in=fopen($filename_in,"w+");
            fwrite($file_in,$input2);
            fclose($file_in);
            $check=100;

            exec("chmod 777 $executable"); 
            exec("chmod 777 $filename_error");
            shell_exec($command_error);
            $error=file_get_contents($filename_error);
            $executionStartTime = microtime(true);
            if(trim($error)=="")
            {
                if(trim($input3)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                if($output==$c->op3){
                    $check=0;
                }
                //echo "<pre>$output</pre>";
                // echo "<textarea disabled id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">Required out:$c->op3\nActual out:$output</textarea><br><br>";
            }
            else if(!strpos($error,"error"))
            {
                echo "<pre>$error</pre>";
                if(trim($input3)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                // echo "<pre>$output</pre>";
                // echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
                        if($output==$c->op3){
                            $check=0;
                        }
            }
            else
            {
                echo "<pre>$error</pre>";
                $check=1;
            }
            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - $executionStartTime;
            $seconds = sprintf('%0.2f', $seconds);
            if($check==1)
            {
                echo "<pre>Verdict : CE</pre>";
                $res[3]=2;
                return;
            }
            else if($check==0 && $seconds>3)
            {
                $res[3]=3;
                echo "<pre>Verdict : TLE</pre>";
                return;
            }
            else if($check==0)
            {
                //accepted
                $res[3]=0;
                // echo "<pre>Verdict : AC</pre>";
            }
            else
            {
                //wrong answer
                $res[3]=1;
                // echo "<pre>Verdict : WA</pre>";
            }

            exec("rm $filename_code");
            exec("rm *.o");
            exec("rm *.txt");
            exec("rm $executable");

       }
       else{
            $CC="g++";
            $out="timeout 5s ./a.out";
            $code=$request->code;
            $input1=$c->tc1;
            $input2=$c->tc2;
            $input3=$c->tc3;
            $filename_code="main.cpp";
            $filename_in="input.txt";
            $filename_error="error.txt";
            $executable="a.out";
            $command=$CC." -lm ".$filename_code;	
            $command_error=$command." 2>".$filename_error;
            $check=100;
            $file_code=fopen($filename_code,"w+");
            fwrite($file_code,$code);
            fclose($file_code);
            $file_in=fopen($filename_in,"w+");
            fwrite($file_in,$input1);
            fclose($file_in);
            exec("chmod -R 777 $filename_in");
            exec("chmod -R 777 $filename_code");  
            exec("chmod 777 $filename_error");	
        
            shell_exec($command_error);
            exec("chmod -R 777 $executable");
            $error=file_get_contents($filename_error);
            $executionStartTime = microtime(true);
        
            if(trim($error)=="")
            {
                if(trim($input1)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                if($output==$c->op1){
                    $check=0;
                }
                //echo "<pre>$output</pre>";
                // echo "<textarea disabled id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">Required out:$c->op1\nActual out:$output</textarea><br><br>";
            }
            else if(!strpos($error,"error"))
            {
                echo "<pre>$error</pre>";
                if(trim($input1)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                // echo "<pre>$output</pre>";
                // echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
                        if($output==$c->op1){
                            $check=0;
                        }
            }
            else
            {
                echo "<pre>$error</pre>";
                $check=1;
            }
            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - $executionStartTime;
            $seconds = sprintf('%0.2f', $seconds);
            if($check==1)
            {
                $res[1]=2;
                echo "<pre>Verdict : CE</pre>";
                return;
            }
            else if($check==0 && $seconds>3)
            {
                $res[1]=3;
                echo "<pre>Verdict : TLE</pre>";
                return;
            }
            else if($check==0)
            {
                //accepted
                $res[1]=0;
                // echo "<pre>Verdict : AC</pre>";
            }
            else
            {
                //wrong answer
                $res[1]=1;
                // echo "<pre>Verdict : WA</pre>";
            }

            $file_in=fopen($filename_in,"w+");
            fwrite($file_in,$input2);
            fclose($file_in);
            $check=100;
            exec("chmod -R 777 $filename_in");
            exec("chmod -R 777 $filename_code");  
            exec("chmod 777 $filename_error");	
        
            shell_exec($command_error);
            exec("chmod -R 777 $executable");
            $error=file_get_contents($filename_error);
            $executionStartTime = microtime(true);
        
            if(trim($error)=="")
            {
                if(trim($input2)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                if($output==$c->op2){
                    $check=0;
                }
                //echo "<pre>$output</pre>";
                // echo "<textarea disabled id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">Required out:$c->op2\nActual out:$output</textarea><br><br>";
            }
            else if(!strpos($error,"error"))
            {
                echo "<pre>$error</pre>";
                if(trim($input2)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                // echo "<pre>$output</pre>";
                // echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
                        if($output==$c->op2){
                            $check=0;
                        }
            }
            else
            {
                echo "<pre>$error</pre>";
                $check=1;
            }
            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - $executionStartTime;
            $seconds = sprintf('%0.2f', $seconds);
            if($check==1)
            {
                echo "<pre>Verdict : CE</pre>";
                $res[2]=2;
                return;
            }
            else if($check==0 && $seconds>3)
            {
                $res[2]=3;
                echo "<pre>Verdict : TLE</pre>";
                return;
            }
            else if($check==0)
            {
                //accepted
                $res[2]=0;
                // echo "<pre>Verdict : AC</pre>";
            }
            else
            {
                //wrong answer
                $res[2]=1;
                // echo "<pre>Verdict : WA</pre>";
            }

            $file_in=fopen($filename_in,"w+");
            fwrite($file_in,$input2);
            fclose($file_in);
            $check=100;

            exec("chmod -R 777 $filename_in");
            exec("chmod -R 777 $filename_code");  
            exec("chmod 777 $filename_error");	
        
            shell_exec($command_error);
            exec("chmod -R 777 $executable");
            $error=file_get_contents($filename_error);
            $executionStartTime = microtime(true);
        
            if(trim($error)=="")
            {
                if(trim($input3)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                if($output==$c->op3){
                    $check=0;
                }
                //echo "<pre>$output</pre>";
                // echo "<textarea disabled id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">Required out:$c->op3\nActual out:$output</textarea><br><br>";
            }
            else if(!strpos($error,"error"))
            {
                echo "<pre>$error</pre>";
                if(trim($input3)=="")
                {
                    $output=shell_exec($out);
                }
                else
                {
                    $out=$out." < ".$filename_in;
                    $output=shell_exec($out);
                }
                // echo "<pre>$output</pre>";
                // echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
                        if($output==$c->op3){
                            $check=0;
                        }
            }
            else
            {
                echo "<pre>$error</pre>";
                $check=1;
            }
            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - $executionStartTime;
            $seconds = sprintf('%0.2f', $seconds);
            if($check==1)
            {
                echo "<pre>Verdict : CE</pre>";
                $res[3]=2;
                return;
            }
            else if($check==0 && $seconds>3)
            {
                $res[3]=3;
                echo "<pre>Verdict : TLE</pre>";
                return;
            }
            else if($check==0)
            {
                //accepted
                $res[3]=0;
                // echo "<pre>Verdict : AC</pre>";
            }
            else
            {
                //wrong answer
                $res[3]=1;
                // echo "<pre>Verdict : WA</pre>";
            }

            exec("rm $filename_code");
            exec("rm *.o");
            exec("rm *.txt");
            exec("rm $executable");

       }

        for($i=1;$i<4;$i++){
            $count += $res[$i];
        }
        if($count==-1){
            echo "Verdict : AC";
            return;
        }
        else if($count==2){
            echo "Verdict : WA";
            return;
        }
        else{
            echo "Verdict : PA";
            return;
        }
    }

    public function registerusers(Test $test, Request $request)
    {
        $student =  Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
        ]);
        $student->save();
       
        $student->tests()->attach($test->id);
    }
}
