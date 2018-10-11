<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function branches()
    {
        return $this->belongsToMany(Branch::class,'course_branches');
    }
}
