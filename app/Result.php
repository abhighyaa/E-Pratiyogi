<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Test;

class Result extends Model
{
    protected $guarded=[];
    public function tests(){
        return $this->belongsToMany(Test::class);
    }
}
