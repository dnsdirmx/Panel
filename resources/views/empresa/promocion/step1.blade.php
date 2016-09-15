@extends('layouts.empresas')
@include('includes.headerEmpresa')
@section('content')

<link rel="stylesheet" href="/css/clockpicker.css" />
<link rel="stylesheet" href="/css/bootstrap-clockpicker.css" />
<link rel="stylesheet" href="/css/bootstrap-clockpicker.min.css" />
<link rel="stylesheet" href="/css/jquery-clockpicker.css" />
<link rel="stylesheet" href="/css/jquery-clockpicker.min.css" />
<link rel="stylesheet" href="/css/pikaday.css">
<link rel="stylesheet" href="/css/panel.css" />
<link rel="stylesheet" href="/css/empresa.css" />
<div class="container-fluid">
	<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="panel">
				<div class="panel-heading nav navbar-inverse">
					<ul class="nav navbar-nav">
          	<li>
							Nueva Campaña
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<form class="form-horizontal">
						<div class="row">
							<div class="col-lg-9 col-md-8 col-sm-7">

									<div class="form-group">
					        	<label for="nombre" class="control-label col-sm-2 text-right">Nombre</label>
					        	<div class="col-sm-4">
					          	<input placeholder="Nombre de la campaña" type="text" class="form-control" id="nombre" required/>
					          </div>
					          <label class="col-sm-2 control-label text-right" for="tipo_promo">Dinámica</label>
					          <div class="col-sm-4">
					          	<select class="form-control" id="tipo_promo" name="tipo_promo" required>
					            	@foreach ($tipo_promos as $tipo)
					              	<option value="{{ $tipo->id }}" >{{ $tipo->nombre }}</option>
					              @endforeach
					            </select>
					          </div>
					        </div>
									<div class="form-group">
							        <label for="descripcion" class="control-label col-sm-2 text-right">Descripción</label>
							        <div class="col-sm-10">
							            <textarea placeholder="Descripción de la dinámica" rows="4" class="form-control" id="descripcion" required="true"></textarea>
							        </div>
							    </div>
									<div class="form-group">
							        <label for="condiciones" class="control-label col-sm-2 text-right">Condiciones</label>
							        <div class="col-sm-10">
							            <textarea placeholder="Condiciones de la dinámica" rows="4" class="form-control" id="condiciones" required="true"></textarea>
							        </div>
							    </div>
									<div class="form-group">
										<label for="dias" class="control-label col-sm-2 text-right">Días validos</label>
										<div class="col-sm-5">
											<input placeholder="Días validos de la campaña" type="hidden" class="form-control" id="dias" required/>
										</div>
									  <div class="col-sm-5">
											<div class="row">
									    	<label for="uahorro" class="control-label">El usuario ahorra&nbsp<span class="glyphicon glyphicon-question-sign"></span></label>
											</div>
											<div class="row">
												<div class="col-sm-12">
									      	<input placeholder="Ahorro del usuario al utilizar la dinámica" type="text" class="form-control" id="uahorro" required/>
									    	</div>
											</div>
											<div class="row">
												<label for="" class="control-label">Horarios</label>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="input-group">
														<label for="hinicia" class="input-group-addon">Inicia</label>
														<input class="form-control clockpicker" type="text" id="hinicia" name="hinicia" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="Inicio" required>
														<label class="input-group-addon">Termina</label>
														<input class="form-control clockpicker" type="text" id="hfinal" name="hfinal" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="Finaliza" required>
													</div>
												</div>
											</div>
											<div class="row" ><label class="cols-sm-12">&nbsp;</label></div>
											<div class="row">
													<div class="col-sm-12">
														<input type="submit" class="btn btn-info col-sm-12" value="Continuar"/>
													</div>
											</div>
									  </div>

									</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-5">
								<div class="panel panel-primary">
									<div class="panel-heading">
    								<h1 class="panel-title">Inversión</h1>
  								</div>
	  							<div class="panel-body">
	    							<div class="row">
											<div class="row" ><label class="hidden">hidden</label></div>
											<div class="col-sm-12">
												<h3><label id="sndias">0</label>&nbsp;D&iacute;as&nbsp;$<label id="costo">0</label>&nbsp;MXN</h3>

											</div>
										</div>
									</div>
									<div class="panel-footer">
											<div class="row">
												<div class="col-sm-12">
													<h2>Total:&nbsp;$<label id="ctotal">0</label>&nbsp;MXN</h2>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
					</form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/js/pikaday.js"></script>
<script type="text/javascript" src="/js/bootstrap-clockpicker.min.js"></script>
<script>
	var picker = new Pikaday({
  	field: document.getElementById('dias'),
    firstDay: 1,
    minDate: new Date(),
    maxDate: new Date(2020, 12, 31),
    yearRange: [2000,2020],
    bound: false,
    multiple: true,
    onMultiSelect: function(dates) {
    	console.log(dates);
			console.log(dates.length);
    	document.getElementById('dias').value = dates;
			document.getElementById('sndias').innerHTML  = dates.length;
			document.getElementById('costo').innerHTML  = dates.length * 10;
			document.getElementById('ctotal').innerHTML  = dates.length * 10;
    }
  });
	$('.clockpicker').clockpicker({
  	donetext: 'Listo',
  	align: 'top',
  	autoclose: true,
  	placement : 'top'
	});
</script>
@endsection
