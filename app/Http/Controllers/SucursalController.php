<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SucursalController extends Controller
{
    public function newSucursal($id, $nombre)
    {
        $sucursal = new \App\Sucursal;
        $sucursal->nombre = $nombre;
        $sucursal->empresa_id = $id;
        $sucursal->save();
        
        $sucursales = \App\Sucursal::all();
        $arrSucursales = [];

        foreach($sucursales as $sucur)
        {
            if($sucur->empresa_id == $id)
            {
                array_push($arrSucursales,$sucur);
            }
        }
        return $arrSucursales;
    }
}
