<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Datetime;

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
        $promos = \App\Promocion::all();
        $mis_promos = [];
        foreach($promos as $promo)
        {
            if($promo->empresa_id == Auth::guard('empresa')->user()->id)
                if(strcmp($promo->estatus,"creado") != 0)
                    array_push($mis_promos,$promo);
        }
        return view('empresa.index',['promociones' => $mis_promos]);
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
            'tipo_promo.required' => 'Selecciona el tipo de campaña',
            'descripcion.required' => 'Es necesario especificar una descripción',
            'nompromo.required' => 'Tienes que indicar el nombre de la campaña',
            'dias.required' => 'Selecciona al menos un dia de promoción',
            'hinicia.required' => 'Selecciona el horario de inicio de la campaña',
            'hfinal.required' => 'Selecciona el horario en el cual finaliza la campaña',
            'imagen.required' => 'Tienes que seleccionar un archivo a enviar',
            'hsucursales.required' => 'Debes seleccionar al menos una sucursal',
            'hrestricciones.required' => 'Debes indicar alguna restricciones'
        ];
        $this->validate($request, [
            'nompromo' => 'required',
            'tipo_promo' => 'required',
            'descripcion' => 'required',
            'dias' => 'required',
            'hinicia' => 'required',
            'hfinal' => 'required',
            'imagen' => 'required|image',
            'hsucursales' => 'required',
            //'hrestricciones' => 'required'
        ],$messages);
        if ($request->hasFile('imagen')) {
            if (!$request->file('imagen')->isValid()) {
                return back()->withErrors(["imagen" => "La imagen no se cargo correctamente."]);
            }

            $promo = \App\Promocion::find($id);
            $promo->nompromo = $request->input('nompromo');
            $promo->descripcion = $request->input('descripcion');
            $promo->tipo_promo_id = $request->input('tipo_promo');
            $promo->hinicia = $request->input('hinicia');
            $promo->hfinaliza = $request->input('hfinal');
            $file = $request->file('imagen')->move("files",$id."promo".$promo->empresa_id.".".$request->file('imagen')->getClientOriginalExtension());
            $promo->imagenfullpath = $file->getPathname();

            $dias = explode(',',$request->input('dias'));

            foreach($dias as $dia)
            {
                $date = date('Y-m-d H:i:s',strtotime($dia));
                $bdDias = new \App\DiaPromo;
                $bdDias->dia = $date;
                $bdDias->promocion_id = $id;
                $bdDias->save();
            }
            $sucursales = explode(',',$request->input('hsucursales'));
            $sucArr = [];
            foreach($sucursales as $sucursal)
            {
                $bdSucursal = new \App\Sucursal;
                $bdSucursal->nombre = $sucursal;
                $bdSucursal->empresa_id = $promo->id;
                $bdSucursal->save();
                array_push($sucArr,$bdSucursal->id);
            }

            $promo->setSucursales($sucArr);
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
            //limpiar bd

            $errPromocions = \App\Promocion::all();
            foreach($errPromocions as $errPromo)
            {
                if(strcmp($errPromo->estatus,"creado") == 0)
                    if($errPromo->empresa_id == $promo->empresa_id)
                        $errPromo->delete();
            }
            return view('empresa.index',['message' => 'Promocion Almacenada']);
        }
        return back()->withErrors(["imagen" => "La imagen no se ha cargado"]);
    }


    public function nuevaPromocion()
    {
        $tipo_promos = \App\TipoPromo::all();

        return view('empresa.promocion.step1',
        ['tipo_promos' => $tipo_promos]);
    }
    public function nuevaPromocionStep2(Request $request)
    {
      $tipo_promos = \App\TipoPromo::all();
      return view('empresa.promocion.step2',
      ['tipo_promos' => $tipo_promos]);
    }
}
