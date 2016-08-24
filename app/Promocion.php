<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    public function setSucursales($sucursales)
    {
        $this->sucursales()->sync($sucursales);
    }
    public function sucursales()
    {
        return $this->belongsToMany('App\Sucursal');
    }
}
