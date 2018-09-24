<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
use App\Tag;

class Question extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    static public function getQuestions(){
        $userid = 1;//Auth::user();
        return Question::where('user_id','=',$userid)->get();
    }
}
