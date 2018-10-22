<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Topic;
use App\Question;

class Subject extends Model
{
    protected $fillable=['id','subject'];
    
    public function topics()
    {
        return $this->belongsToMany(Topic::class,'subject_topic');
    }
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    //
    public function instructions()
    {
        return $this->hasMany(Instruction::class);
    } 
    public function branches()
    {
        return $this->belongsToMany('App\Branch','course_branch_subjects');
    }
    public function courses()
    {
        return $this->belongsToMany('App\Course','course_branch_subjects');
    }
}
