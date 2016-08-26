@extends('layouts.empresas')
@include('includes.headerEmpresa')
@section('content')
	<link rel="stylesheet" href="/css/empresa.css" />
	<link rel="stylesheet" href="/css/clockpicker.css" />
	<link rel="stylesheet" href="/css/bootstrap-clockpicker.css" />
    <link rel="stylesheet" href="/css/bootstrap-clockpicker.min.css" />
	<link rel="stylesheet" href="/css/jquery-clockpicker.css" />
	<link rel="stylesheet" href="/css/jquery-clockpicker.min.css" />
	<link rel="stylesheet" href="/css/pikaday.css">
	<link rel="stylesheet" href="/css/panel.css" />






	<div class="container-fluid">
		<div class="row" >
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
				<div class="panel">
					<div class="panel-heading nav navbar-inverse">
						<ul class="nav navbar-nav">
                  			<li>
								Nueva Promoción
							</li>
						</ul>
					</div>
					<div class="panel-body">
						<form id="guardarForm" class="form-horizontal"  method="POST" action="savePromo/{{$promo->id}}" enctype="multipart/form-data">
							<fieldset >
								{!! csrf_field() !!}
								<div>
									<ul id="diverror">
									@if (count($errors) > 0)
										@foreach($errors->all() as $error)
											<li class="alert alert-danger">{{ $error }}</li>
										@endforeach	
									@endif
									</ul>
								</div>
								<!-- hidden fields -->
								<input type="hidden" id="idPromo" value="{{$empresa}}"/>
								<input type="hidden" id="dias" name="dias">
								<input type="hidden" id="hsucursales" name="hsucursales">
								<input type="hidden" id="hrestricciones" name="hrestricciones">
						
						

								<!-- visible fields -->
								<div class="form-group">
									<label class="col-sm-3 control-label">
										Dinámica
										<font class="need-field">*</font>
									</label>
									<div class="col-sm-9">
										<select class="form-control" id="tipo_promo" name="tipo_promo" required>
											@foreach ($tipo_promos as $tipo)
												<option value="{{ $tipo->id }}" >{{ $tipo->nombre }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">
										Descripción
										<font class="need-field">*</font>
									</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="3"  id="descripcion" name="descripcion" placeholder="Descripcion " required></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3" for="datepicker">
										Dias válidos<font class="need-field">*</font>
									</label>
									<div class="col-sm-6" id="container" style="z-index:10">
									</div>
								<div class="form-group">
									<span class="col-sm-12 text-center">
										
									</span>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3">
										Horarios
										<font class="need-field">*</font><br>
										Formato de 24 horas (HH:MM)
									</label>
									<div class="col-sm-8 col-sm-offset-1">
											<div class="form-group clockpicker col-sm-6 input-group">
												<label class="input-group-addon">Inicia</label>
												<input class="form-control" type="text" id="hinicia" name="hinicia" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="Inicio" required>
											</div>
											<div class="form-group clockpicker col-sm-6 input-group">
												<label class="input-group-addon">Termina</label>
												<input class="form-control" type="text" id="hfinal" name="hfinal" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="Finaliza" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<span class="control-label col-sm-3" >Sucursales participantes<font class="need-field">*</font></span>
									<div class="col-xs-8">
									<!--
										<select  class="form-control" id="sucursales" name="sucursales" multiple required >
											@if (count($sucursales) > 0)
												@foreach($sucursales as $sucursal)
													<option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
												@endforeach
											@endif
										</select>
										-->
										<div id="sucurContainer" class="col-sm-12">
											<div class="input-group col-sm-12">
												<input type="text" placeholder="Dirección" class="col-xs-12 form-control sucursales" id="inputSucur' + i + '"  required> 	
											</div>
											<br>
										</div>
										<div class="form-group">
											<button class="col-sm-6 col-sm-offset-1  btn btn-primary" type="button" onClick="addSucur()">
												Agregar sucursal
												<font class="need-field">*</font>
											</button>
										</div>
									</div>
								</div>
								
								<div class="col-sm-12" id="restContainer">
									<div class="form-group ">
										<span class="control-label col-sm-3" >Condiciones<font class="need-field">*</font></span>
										<div class="input-group col-sm-9">
											<textarea class="form-control restricciones" rows="3" placeholder="Condiciones" /></textarea>
										</div>
					  				</div>
								</div>
							<!--
								<div class="form-group">
									<button class="col-sm-4 col-sm-offset-3 btn btn-primary" onClick="add()" type="button">
										Agregar condición
										<font class="need-field">*</font>
									</button>
								</div>
								-->
								
								<div class="form-group">
									<label class="btn btn-default btn-file col-sm-2 col-sm-offset-3">
    									Imagen<font class="need-field">*</font>
										<input id="imagen" name="imagen" type="file" accept=".png" required>
									</label>
								</div>
								<div class="form-group">
									<label class="col-sm-5 col-sm-offset-3">Formato: PNG, Ancho: 500px, Alto: 300px</label>
									<input value="Ver ejemplo" class="col-sm-2 btn btn-primary " data-toggle="modal" data-target="#myModal">
								</div>
								
								<div class="form-group">
									<button class="btn btn-success col-sm-8 col-sm-offset-2" type="submit"  >
										Envíar
									</button>
								</div>


<div class="modal fade" style="" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h4 class="modal-title" id="myModalLabel">Imagen de ejemplo</h4>
      				</div>
      				<div class="modal-body">
					  <img src="/images/ejemplo.jpeg">
      				</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      			</div>
    		</div>
  		</div>
	</div>

							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>



	


	<script type="text/javascript" src="/js/clockpicker.js"></script>
	<script type="text/javascript" src="/js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.11.1.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.multidatespicker.js"></script>
	<script type="text/javascript" src="/js/jquery-clockpicker.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap-clockpicker.js"></script>
	<script type="text/javascript" src="/js/jquery-clockpicker.js"></script>
	<script type="text/javascript" src="/js/bootstrap-clockpicker.min.js"></script>
	<script type="text/javascript" src="/js/pikaday.js"></script>


	<script type="text/javascript" src="/js/newpromo.js"></script>
@endsection