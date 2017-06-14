<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $fillable = ['display_name','slug'];
    public $timestamps = false;
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
