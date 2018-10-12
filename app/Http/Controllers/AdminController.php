<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\User;
use App\role;
use App\Course;
use App\Branch;
use App\Subject;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
        $this->middleware('admin');
      }
        public function index()
      {
        return view('layouts.AdminPanel');
      }

      public function FetchUsers()
    {
      $users = User::whereHas('role', function($q) {
        $q->where('role_id','!=', 1);      
      })->with('role')->get();
      return $users;
    }
    public function Fetch_all_teachers()
    {
         $teachers = User::whereHas('role', function($q) {
           $q->where('role_id', 2);                 
         })->with('role')->get();
        return $teachers;
    }
     public function Fetch_all_students()
    {
         $students = User::whereHas('role', function($q) {
           $q->where('role_id', 3);                 
         })->with('role')->get();
        return $students;
    }
    public function Fetch_all_roles()
    {
      $roles = role::all();
      return $roles;
    }
    public function Remove_user(Request $request)
    {
      User::where('id',$request->id)->delete();
      $users = User::whereHas('role', function($q) {
        $q->where('role_id','!=', 1);      
      })->with('role')->get();
      return $users;
    }
    public function update_role_of_user(Request $request)
    {
       $user = User::where('id',$request->id)->first();
       $user->role()->detach($user->role()->first()->id);
      $role = role::where('name',$request->name)->first();
      
      $user->role()->attach($role->id);
      return $user->role()->first();
    }
    public function FetchCourses()
    {
      $course = Course::all();
      return $course;
    }
    public function update_course(Request $request)
    {
       Course::where('id',$request->id)->update(['name' => $request->name]);
       $courses = Course::all();
       return response()->json($courses);
    }
    public function Fetch_branches_with_course()
    {
      $branch = new Branch;
      return $branch->with('courses_branches')->get();
    }
    public function update_branch(Request $request)
    {
        Branch::where('id',$request->id)->update(['name' => $request->name]);
        $branch = new Branch;
        return $branch->with('courses')->get();
    }
    public function Fetch_subjects_with_course_branch()
    {
      
      $subjects  =  Subject::with('branches')->with('courses')->get();
      return $subjects;
    }


}











