<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Empresa extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'ciudad',
        'direccion',
        'telefono',
        'giro_id',
        'codpromotor',
    ];
}
