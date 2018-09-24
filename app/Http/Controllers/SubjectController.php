<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Instruction;
use Requests;

class SubjectController extends Controller
{
   public function fetchSubjects()
   {
        $subjects = Subject::all();
        return response()->json($subjects);
   }
   
   public function fetchInstructions(Request $request)
   {
       $instructions = Instruction::where('subject_id',$request->id)->get();
       return response()->json($instructions);
    }
    
}
