@extends('layouts.admin')
@include('includes.headerAdmin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="table-responsive col-lg-8 col-lg-offset-2 table-bordered">
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Contacto</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Promotor</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->name }}</td>
                        <td>{{ $empresa->nombre_contacto }}</td>
                        <td>{{ $empresa->direccion }}</td>
                        <td>{{ $empresa->telefono }}</td>
                        <td>{{ $empresa->email }}</td>
                        <td>
                            @foreach ($ciudades as $ciudad)
                                @if ($ciudad->cve_mun == $empresa->ciudad && $ciudad->cve_ent == $empresa->estado)
                                    {{ $ciudad->nom_mun }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($estados as $estado)
                                @if( $estado->cve_ent == $empresa->estado)
                                    {{ $estado->nom_ent }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $empresa->cod_promotor }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            
        </div>
    </div>
</div>
@endsection