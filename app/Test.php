<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Question;

class Test extends Model
{
    protected $fillable=['id','test'];
    public function users(){
        
        return $this->belongsToMany(User::class);
    }
    public function questions(){
        
        return $this->belongsToMany(Question::class);
    }
}
