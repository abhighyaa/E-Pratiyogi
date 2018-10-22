<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
<<<<<<< HEAD
    //
=======
    public function users()
    {
        return $this->belongsToMany(User::class,'role_users');
    }
>>>>>>> a33104e9578b1c5fbb66d21bf43b8abae165471a
}
