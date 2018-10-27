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
    public function add_course(Request $request)
    {
      if($request->name == 'null')
        {
            return 'Empty course name can not be added';
        }
        else{
            Course::create(['name' => $request->name]);
            $course = Course::all();
            return $course;
        }
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
      return $branch->with('courses_branches')->orderBy('name')->get();
      
    }
    public function update_branch(Request $request)
    {
        Branch::where('id',$request->id)->update(['name' => $request->name]);
        $branch = new Branch;
        return $branch->with('courses_branches')->get();
    }
    public function add_branch_to_course(Request $request)
    {
      if($request->course == 'Select a course name')
      {
        return 'please select a course name first';
      }
      else if($request->branch == 'null')
      {
        return 'branch name is required';
      }
      $course = Course::where('name',$request->course)->first();
      $courseId = $course->id;
      $branch_from_course = $course->branches()->where('name',$request->branch)->first();
      if($branch_from_course)
      {
        $branch_course_id =  $branch_from_course->pivot->course_id;
        if($branch_course_id == $courseId)
        {
          return 'this branch is already exist in selected course';
        }
      }
      else
      {  
        $branch = Branch::create(['name' => $request->branch]);
        $branchId =  $branch->id;
        $course->branches()->attach($branchId);
        $branch = new Branch;
        return $branch->with('courses_branches')->get();
      }  
    }
    public function Fetch_subjects_with_course_branch()
    {
      
      $subjects  =  Subject::with('branches')->with('courses')->get();
      return $subjects;
    }
    public function fetch_branches_for_this_course(Request $request)
    {
      $course = Course::where('name',$request->course)->first();
      $branches_of_selected_course = $course->branches;
      return $branches_of_selected_course;
    }
    public function add_subject(Request $request)
    {
      if($request->course == 'Select a course name')
        {
           return 'please select a course name first';
        } 
        else if($request->branch == 'select a branch name')
        {
          return 'please select a branch name first';
        } 
        else if($request->subject == 'null')
        {
         return 'subject name is required';
        }
      $course = Course::where('name',$request->course)->first();
      $branch = Branch::where('name',$request->branch)->first();
      $exist_subject = $branch->subjects()->where('subject',$request->subject)->first();
      if($exist_subject)
      {
         if($exist_subject->pivot->branch_id == $branch->id)
         {
          return 'this subject is already present in selected branch';
         }
      }
      else
      {
        $subject = Subject::create(['subject' => $request->subject]);
        $subject = Subject::where('subject',$request->subject)->first();
        $subject->branches()->attach($branch->id, ['course_id'=>$course->id]);
        return Subject::with('branches')->with('courses')->get();
      }

    }
    public function remove_subject(Request $request)
    {
      $subject = Subject::where('id',$request->id)->first();
      $branch_id =  $subject->branches()->first()->pivot->branch_id;
      $course_id = $subject->courses()->first()->pivot->course_id;
      $subject->delete();
      $subject->branches()->detach($branch_id, ['course_id'=>$course_id]);
      return Subject::with('branches')->with('courses')->get();
    }


}











