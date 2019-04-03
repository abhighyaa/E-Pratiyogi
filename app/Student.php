<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Test;

class Student extends Model
{
    protected $fillable=['id','name','email','contact'];
    public function tests(){
        
        return $this->belongsToMany(Test::class);
    }
}
