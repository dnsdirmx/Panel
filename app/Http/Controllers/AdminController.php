<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        return view('admin.index');
    }
    public function empresas()
    {
        $empresas = \App\Empresa::all();
        $ciudades = \App\Ciudad::all();
        $estados = \App\Estado::all();

        $nuevasEmpresas = [];
        foreach($empresas as $empresa)
        {
            if($empresa->state == "NUEVA")
                array_push($nuevasEmpresas,$empresa);
        }
        return view('admin.empresas',['empresas' => $empresas,
                                    'empresasnuevas' => $nuevasEmpresas,
                                    'ciudades' => $ciudades,
                                    'estados' => $estados]);
    }
}
