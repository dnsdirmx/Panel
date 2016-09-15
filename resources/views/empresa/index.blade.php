@extends('layouts.empresas')
@include('includes.headerEmpresa')
@section('content')

<link rel="stylesheet" href="/css/empresa.css" />
<link rel="stylesheet" href="/css/panel.css" />
<link rel="stylesheet" href="/css/pikaday.css">
<script type="text/javascript" src="/js/pikaday.js"></script>

<div class="container-fluid">
    <div class="row">
        @if(isset($message))
            <div class="row ">
                <div class="alert alert-info" role="alert">
                    {{$message}}
                </div>
            </div>
        @endif
    </div>
    <div class="row">

    <div class="col-lg-4 col-md-4  col-sm-4">
            <div class="panel">
                <div class="panel-heading nav navbar-inverse">
                    <ul class="nav navbar-nav">
                  	    <li>
						    Autorizadas
						</li>
					</ul>
                </div>
                <div class="panel-body scrollable">
                    @if(isset($promociones))
                        @foreach ($promociones  as $promocion)
                            @if(strcmp($promocion->estatus,"autorizada") == 0)
                                <div class="row">{{ $promocion->descripcion}}</div>
                            @endif
                        @endforeach
                    @endif
                    
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-4  col-sm-4">
            <div class="panel">
                <div class="panel-heading nav navbar-inverse">
                    <ul class="nav navbar-nav">
                  			<li>
								Pendientes
							</li>
						</ul>
                </div>
                <div class="panel-body scrollable">
                    @if(isset($promociones))
                        @foreach ($promociones  as $promocion)
                            @if(strcmp($promocion->estatus,"guardado") == 0)
                                <div class="panel panel-default">
                                    <div class="panel-body ">
                                        <label>Nombre:&nbsp;</label><span>{{ $promocion->nompromo}}</span><br>
                                        <label>Descripción:&nbsp;</label><span>{{ $promocion->descripcion}}</span>
                                    </div>
                                    <div class="panel-footer"><span onClick="obtienePromocion({{ $promocion->id }})" class="label label-info">Ver campaña</span></div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        

        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="panel">
                <div class="panel-heading nav navbar-inverse">
                    <ul class="nav navbar-nav">
                  	    <li>
						    Rechazadas
						</li>
					</ul>
                </div>
                
                <div class="panel-body scrollable">
                    @if(isset($promociones))
                        @foreach ($promociones  as $promocion)
                            @if(strcmp($promocion->estatus,"rechazada") == 0)
                                <div class="row">{{ $promocion->descripcion}}</div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="promocionview" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
            <p class="col-sm-3">Campaña:</p><strong><p id="promonombre"></p></strong>
        </h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <input type="hidden" id="idpromo"/>
            </div>
            <div class="row">
                <p class="col-sm-3">Dinámica:</p><strong><p id="tipo"></p></strong>
            </div>
            <div class="row">
                <p class="col-sm-3">Descripción:</p><strong><p id="descripcion"></p></strong>
            </div>
            <div class="row">
                <p class="col-sm-3">Fecha de creación:</p><strong><p id="fechacreacion"></p></strong>
            </div>
            
            <div class="row">
                <div class="col-sm-3">
                    <button class="btn btn-xs btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Ver mas
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="collapse col-sm-12" id="collapseExample">
                    <div class="row">
                        <p class="col-sm-3">Hora de inicio:</p><strong><p id="hinicio" class="col-sm-3"></p> </strong>
                        <p class="col-sm-3">Hora de termino:</p><strong><p id="hfinaliza" class="col-sm-3"></p></strong>
                    </div>
                    <div class="row">
                        <p class="col-sm-3">Sucursales:</p>
                        <div id="divsucursales" class="col-sm-9">
                        </div>
                    </div>
                    <div class="row">
                        <p class="col-sm-3">Días validos:</p><input type="text" id="ndias"/>
                        <div id="pickadaydiv" class="col-sm-9"></div>
                    </div>
                    <div class="row">
                        <p class="col-sm-3">Condiciones:</p>
                        <strong><p class="col-sm-9" id="pcondiciones"></p></strong>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <img id="promoimg" height="300" width="500"/>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection