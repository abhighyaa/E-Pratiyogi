<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subject;
use App\Question;

class Category extends Model
{
    // protected $fillable=['id'];
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
    public function questions()
    {
         return $this->belongsToMany(Question::class)->withPivot('category');
    }
}
