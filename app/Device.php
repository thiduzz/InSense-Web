<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model {
    protected $fillable = ['model'];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
