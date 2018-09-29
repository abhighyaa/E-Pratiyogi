<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
use App\Topic;
use App\Subject;

class Question extends Model
{
    protected $casts=[
        'choices'=>'array'
    ];
    protected $fillable=['id','question','answer','choices','complexity','type'];
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    static public function getQuestions(){
        $userid = 1;//Auth::user();
        return Question::all();
    }
}
