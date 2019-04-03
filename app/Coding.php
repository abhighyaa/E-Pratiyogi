<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Test;

class Coding extends Model
{
    protected $fillable=['id','question','tc1','op1','tc2','op2','tc3','op3','complexity'];
    public function tests()
    {
        return $this->belongsToMany(Test::class);
    }
}
