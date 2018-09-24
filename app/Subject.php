<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    public function instructions()
    {
        return $this->hasMany(Instruction::class);
    } 
}
