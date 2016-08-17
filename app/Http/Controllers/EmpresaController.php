<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class EmpresaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:empresa');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('empresa.index');
    }

    public function newPromo()
    {
        $tipo_promos = \App\TipoPromo::all();
        $promo = new \App\Promocion;
        $promo->empresa_id = Auth::guard('empresa')->user()->id;
        $promo->save();

        return view('empresa.newPromo',['tipo_promos' => $tipo_promos, 'promo' => $promo]);
    }
    public function savePromo(Request $request, $id)
    {
        $messages = [
            'tipo_promo.required' => 'Selecciona el tipo de promoción',
            'descripcion.required' => 'Es necesario especificar una descripción',
            'dias.required' => 'Selecciona al menos un dia de promoción',
            'hinicia.required' => 'Selecciona el horario de inicio de la promocion',
            'hfinal.required' => 'Selecciona el horario en el cual finaliza la promocion',
            'imagen.required' => 'tienes que seleccionar un archivo a enviar',
        ];
        $this->validate($request, [
            'tipo_promo' => 'required',
            'descripcion' => 'required',
            'dias' => 'required',
            'hinicia' => 'required',
            'hfinal' => 'required',
            'imagen' => 'required'
        ],$messages);

        $promo = \App\Promocion::find($id);
        $promo->descripcion;
        return view('empresa.index',['message' => 'Promocion Almacenada']);
    }
}