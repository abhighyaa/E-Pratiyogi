<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Question;
use Auth;

class Tag extends Model
{
    protected $fillable=['user_id','name'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
    
    static public function getTags(){
        $userid = Auth::user()->id; 
        return Tag::where('user_id','=',$userid)->get();
    }

}
