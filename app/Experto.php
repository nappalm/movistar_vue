<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Experto extends Authenticatable
{
    protected $fillable = [
        'email', 'password','id_pdv',
    ];
    
    
    protected $table = 'usuarios_experto';
}
