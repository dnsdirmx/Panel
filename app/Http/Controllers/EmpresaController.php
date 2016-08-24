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
        $sucls = \App\Sucursal::all();
        $sucursales = [];
        foreach($sucls as $sucursal)
        {
            if($sucursal->empresa_id == Auth::guard('empresa')->user()->id)
            {
                array_push($sucursales,$sucursal);
            }
        }


        $promo = new \App\Promocion;
        $promo->empresa_id = Auth::guard('empresa')->user()->id;
        $promo->estatus = "creado";
        $promo->save();

        return view('empresa.newPromo',['tipo_promos' => $tipo_promos,
                                         'promo' => $promo, 
                                        'sucursales' => $sucursales,
                                        'empresa' => $promo->empresa_id
                                        ]);
    }
    public function savePromo(Request $request, $id)
    {
        //dd($request);
        $messages = [
            'tipo_promo.required' => 'Selecciona el tipo de promoción',
            'descripcion.required' => 'Es necesario especificar una descripción',
            'dias.required' => 'Selecciona al menos un dia de promoción',
            'hinicia.required' => 'Selecciona el horario de inicio de la promocion',
            'hfinal.required' => 'Selecciona el horario en el cual finaliza la promocion',
            'imagen.required' => 'Tienes que seleccionar un archivo a enviar',
            'hsucursales.required' => 'Debes seleccionar al menos una sucursal',
            'hrestricciones.required' => 'Debes indicar alguna restricciones'
        ];
        $this->validate($request, [
            'tipo_promo' => 'required',
            'descripcion' => 'required',
            'dias' => 'required',
            'hinicia' => 'required',
            'hfinal' => 'required',
            'imagen' => 'required|image',
            'hsucursales' => 'required',
            'hrestricciones' => 'required'
        ],$messages);
        if ($request->hasFile('imagen')) {
            if (!$request->file('imagen')->isValid()) {
                return back()->withErrors(["imagen" => "La imagen no se cargo correctamente."]);   
            }

            $promo = \App\Promocion::find($id);
            $promo->descripcion = $request->input('descripcion');
            $promo->tipo_promo_id = $request->input('tipo_promo');
            $promo->hinicia = $request->input('hinicia');
            $promo->hinicia = $request->input('hfinal');
            $file = $request->file('imagen')->move("files",$id."promo".$promo->empresa_id.".".$request->file('imagen')->getClientOriginalExtension());
            $promo->imagenfullpath = $file->getPathname();

            $dias = explode(',',$request->input('dias'));
            //dd($dias);
            foreach($dias as $dia)
            {
                $bdDias = new \App\DiaPromo;
                $bdDias->dia = $dia;
                $bdDias->promocion_id = $id;
                $bdDias->save();
            }
            $sucursales = explode(',',$request->input('hsucursales'));
            $promo->setSucursales($sucursales);
            $promo->estatus = "guardado";

            $restricciones = explode(',',$request->input('hrestricciones'));
            foreach($restricciones as $restriccion)
            {
                $bdRestriccion = new \App\Restriccion;
                $bdRestriccion->nombre = $restriccion;
                $bdRestriccion->promocion_id = $promo->id;
                $bdRestriccion->save();
            }

            $promo->save();
            return view('empresa.index',['message' => 'Promocion Almacenada']);
        }
        return back()->withErrors(["imagen" => "La imagen no se ha cargado"]);
    }
}