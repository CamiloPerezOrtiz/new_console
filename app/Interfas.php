<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interfas extends Model
{
    protected $fillable = [
        'interfas', 'name', 'type', 'ip', 'group', 'campus'
    ];
}
