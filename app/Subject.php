<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Topic;
use App\Question;
use App\Category;

class Subject extends Model
{
    protected $fillable=['id','subject'];
    
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
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
}
