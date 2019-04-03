<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Student;
use App\Question;
use App\Attempt;
use App\Result;

use App\Coding;
class Test extends Model
{
    protected $fillable=['id','test'];
    public function users(){
        
        return $this->belongsToMany(User::class);
    }
    public function students(){
        
        return $this->belongsToMany(Student::class);
    }
    public function questions(){
        
        return $this->belongsToMany(Question::class);
    }

    public function attempts(){
        
        return $this->belongsToMany(Attempt::class);
    }

    public function results(){   
        return $this->belongsToMany(Result::class);
    }
    public function codings(){
        
        return $this->belongsToMany(Coding::class);
    }
}
