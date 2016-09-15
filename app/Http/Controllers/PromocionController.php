<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class PromocionController extends Controller
{
    public function getPromocion($id)
    {
            $promocion = \App\Promocion::find($id);
            if($promocion == null)
                return response(null,404);
            $promocion->sucursales = $promocion->sucursales()->get();
            //dd($promocion->dias()->get());
            $promocion->promo_tipo = \App\TipoPromo::find($promocion->tipo_promo_id)->nombre;
            $promocion->dias = $promocion->dias()->get();
            $promocion->condiciones = $promocion->condiciones()->get();
            return response($promocion,200);
    }
    public function getImagen($id)
    {
        $promocion = \App\Promocion::find($id);
        if($promocion == null)
            return response(null,404);
        
        return \Response::download($promocion->imagenfullpath);
    }
}