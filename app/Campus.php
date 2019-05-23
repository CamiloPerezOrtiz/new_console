<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function interfaces()
    {
        return $this->hasMany('App\Group');
    }
}
