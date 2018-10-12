<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    // public function courses()
    // {
    //     return $this->belongsToMany('App\Course','course_branch_subjects');
    // }
    public function subjects()
    {
        return $this->belongsToMany('App\Subject','course_branch_subjects');
    }
     public function courses_branches()
    {
    	 return $this->belongsToMany('App\Course','branch_courses');
    }
}
