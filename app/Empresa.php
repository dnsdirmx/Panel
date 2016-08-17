<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Empresa extends Authenticatable
{
    protected $fillable = [
        'nombre_contacto',
        'name',
        'email',
        'password',
        'estado',
        'ciudad',
        'direccion',
        'telefono',
        'giro_id',
        'cod_promotor',
    ];
}
