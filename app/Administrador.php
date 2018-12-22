<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrador extends Authenticatable
{
    protected $fillable = [
        'email', 'password',
    ];
    protected $table = 'usuarios_administrador';
}
