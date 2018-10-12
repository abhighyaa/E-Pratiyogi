<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function courses()
    {
        return $this->belongsToMany('App\Course','branch_courses');
    }
    public function subjects()
    {
        return $this->belongsToMany('App\Subject','branch_subjects');
    }
}
