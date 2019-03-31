<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Question;
use App\Attempt;
use App\Result;

class Test extends Model
{
    protected $fillable=['id','test'];
    public function users(){
        
        return $this->belongsToMany(User::class);
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
}
