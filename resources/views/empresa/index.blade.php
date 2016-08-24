@extends('layouts.empresas')
@include('includes.headerEmpresa')
@section('content')
<link rel="stylesheet" href="/css/empresa.css" />
<div class="container">

    @if(isset($message))
    <div class="row">
        {{$message}}
    </div>
    @endif

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    Sesión iniciada
                </div>
            </div>
        </div>
    </div>
</div>
@endsection