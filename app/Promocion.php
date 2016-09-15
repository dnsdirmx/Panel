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

    public function dias()
    {
        return \DB::table('dia_promos')->where('promocion_id', $this->id);
        //return $this->belongsTo('App\DiaPromo');
    }

    public function condiciones()
    {
        return $this->hasMany('App\Restriccion');
    }
}
