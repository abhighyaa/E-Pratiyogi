<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Subject;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tests(){
        return $this->belongsToMany(Test::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function is_admin()
    {
        if($this->admin)
            return true;
        return false;
    }

    public function role()
    {
        return $this->belongsToMany(role::class,'role_users');
    }
}
