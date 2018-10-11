<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function course()
    {
        return $this->belongsToMany(Course::class,'course_branches');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'branch_subjects');
    }
}
