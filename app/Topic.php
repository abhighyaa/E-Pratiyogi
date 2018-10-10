<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Question;
use App\Subject;
use Auth;

class Topic extends Model
{
    protected $fillable=['id','topic'];
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
    
    static public function getTopics(){
        $userid = Auth::user()->id; 
        return Topic::all();
    }

}
