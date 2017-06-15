<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public function role()	{
        return $this->belongsTo('App\Role','role_id','id');
    }

    public function devices()	{
        return $this->hasMany('App\Device');
    }


    public function hasRole($role)
    {
        if(is_string($role))
        {
            return ($this->role->slug == $role ? true : false);
        }
        return $this->role_id == $role;
    }
}
