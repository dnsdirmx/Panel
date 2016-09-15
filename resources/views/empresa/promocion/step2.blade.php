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
<link rel="stylesheet" href="/css/awesome-bootstrap-checkbox.css"/>
<link rel="stylesheet" href="/bower_components/Font-Awesome/css/font-awesome.css">
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
							<div class="col-lg-8 col-md-7 col-sm-6">
                <div class="form-group">
									<span class="control-label col-sm-12" >Sucursales participantes<font class="need-field">*</font></span>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
										<div id="sucurContainer" class="col-sm-12">
											<div class="input-group col-sm-12">
                        <div class="input-group">
                          <div class="input-group-addon">Nombre</div>
                          <input type="text" class="form-control" id="exampleInputAmount" placeholder="Nombre">
                          <div class="input-group-addon">Dirección</div>
                          <input type="text" class="form-control" id="exampleInputAmount" placeholder="Direccion">
                          <div class="input-group-addon">Telefono</div>
                          <input type="text" class="form-control" id="exampleInputAmount" placeholder="Telefono">
                        </div>
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
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <div class="checkbox checkbox-success">
                        <input type="checkbox" id="checkbox1">
                        <label for="checkbox1">
                          ¿Quieres aparecer en destacados? <span class="glyphicon glyphicon-question-sign"></span>(Recomendado)
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-sm-6 col-12">
                    <div class="input-group">
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          Cargar Imagen&hellip; <input type="file" style="display: none;" multiple>
                        </span>
                      </label>
                      <input type="text" class="form-control" readonly required="true">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6">
								<div class="panel panel-primary">
									<div class="panel-heading">
    								<h1 class="panel-title">Inversión</h1>
  								</div>
	  							<div class="panel-body">
	    							<div class="row">
											<div class="row" ><label class="hidden">hidden</label></div>
											<div class="col-sm-12">
												<h3><label id="sndias">0</label>&nbsp;D&iacute;as&nbsp;$<label id="costo">0</label>&nbsp;MXN</h3>

                        <h3><label id="csucursales">1</label>&nbsp;Sucursales:&nbsp;$<label id="cossucursales">10</label>&nbsp;MXN</h3>
											</div>
										</div>
									</div>
									<div class="panel-footer">
											<div class="row">
												<div class="col-sm-12">
													<h2>Total:&nbsp;$<label id="ctotal">10</label>&nbsp;MXN</h2>
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

<script type="text/javascript">
$(function() {

// We can attach the `fileselect` event to all file inputs on the page
$(document).on('change', ':file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

// We can watch for our custom `fileselect` event like this
$(document).ready( function() {
    $(':file').on('fileselect', function(event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
});

});
var i = 0;
function addSucur(){
    i++;
    var raiz = document.createElement('div');
    raiz.setAttribute("class","form-group col-sm-12");
    raiz.id = 'divSucur' + i;
    var node = document.createElement('div');
	node.setAttribute("class","input-group sucursales col-sm-12");
  //node.setAttribute("id","inputSucur\' + i + \'");

	node.innerHTML = '<div class="input-group-addon">Dirección</div>\
                        <input type="text" class="form-control" id="exampleInputAmount" placeholder="Direccion"> \
                        <div class="input-group-addon">Telefono</div>\
                        <input type="text" class="form-control" id="exampleInputAmount" placeholder="Telefono">\
                        <span class="input-group-btn ">\
                        <input type="button"  class="btn btn-danger" value="X" onClick="deleteRest(\'divSucur' + i + '\')"> \
                        </span>\
                      </div>';
    raiz.appendChild(node);
    document.getElementById('sucurContainer').appendChild(raiz);
    var nsuc = $("#").text();
}
function deleteRest(nameDiv)
{
    document.getElementById(nameDiv).remove();
}

</script>
@endsection
