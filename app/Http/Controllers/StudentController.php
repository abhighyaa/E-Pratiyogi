<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Subject;
use App\User;
use App\Instruction;
use Requests;
use App\Notifications\RequestToChangeRole;
use Notification;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth'); 
        $this->middleware('user');
      }
        public function index()
      {
          return view('home');
      }

      public function manageProfile(Request $request){
          $user = User::findOrFail($request->id);
          if($user->role->first()->name == 'student');
            return view('Student.ManageProfile');
          return "Teacher";
    }
    public function getTeachers()
    {
        $teachers = User::whereHas('role', function($q) {
            $q->where('role_id', 2);                 
          })->with('role')->get();
         return response()->json($teachers);
    }
    public function RequestToChangeRole(Request $request){

        $username = $request->username;
        $email = $request->email;
        $contact = $request->contact;
        $address = $request->address;
        $skill = $request->skill;
        $qualification = $request->qualification;
        $year = $request->year;
        $percentage = $request->percentage;
        $role = $request->role;

        $title = "Request To Change Role";
        $body  = "Username <b>$request->username</b> with email <b>$request->email</b> has requested to change role.";
        
        $admin = User::whereHas('role', function($q){
            $q->where('role_id', 1);                 
          })->with('role')->first();

        $RequestLetter = collect([
          'title' => $title,
          'body' =>  $body,
          'username' =>  $username,
          'email' =>  $email,
          'contact' =>  $contact,
          'address' =>  $address,
          'skill' =>  $skill,
          'qualification' =>  $qualification,
          'year' =>  $year,
          'percentage' =>  $percentage,
          'role' =>  $role
       ]);

       Notification::send($admin,new RequestToChangeRole($RequestLetter));
       return redirect('/student/home')->with('success','Request sent successfully !!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
  
 
}
