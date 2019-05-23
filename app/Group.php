<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
    ];

    public function user()
    {
    	return $this->hasMany('App\User');
    }

    public function campus()
    {
    	return $this->hasMany('App\Campus');
    }
}
