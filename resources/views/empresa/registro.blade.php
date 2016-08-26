@extends('layouts.empresas')

@include('includes.headerAccesoEmp')

@section('content')
<link rel="stylesheet" href="/css/empresa.css" />
<link rel="stylesheet" href="/css/panel.css" />

<div class="container-fluid">
	<div class="row" >
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-heading nav navbar-inverse">
						<ul class="nav navbar-nav">
                  			<li>
								Registrarse
							</li>
						</ul>
				</div><div class="panel-body">
                    <form method="POST" action="{{ url('/empresa-register') }}">
                        <fieldset>
                            {{ csrf_field() }}
                            <div>
                            @if(count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Nombre del contacto <font class="need-field">*</font>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control margin-bottom" type="text" name="nombre_contacto" id="nombre_contacto" placeholder="Nombre del contacto" required/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Nombre de la empresa<font class="need-field">*</font>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control margin-bottom" type="text" name="name" id="name" placeholder="Nombre de la empresa" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Estado<font class="need-field">*</font>
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control margin-bottom" onChange="seleccionaEstado()" name="estado" id="estado" required>
                                        @foreach ($estados as $estado)
                                            <option  value="{{ $estado->cve_ent}}">{{ $estado->nom_ent }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Ciudad<font class="need-field">*</font>
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control margin-bottom" name="ciudad" id="ciudad" required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Dirección<font class="need-field">*</font>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control margin-bottom" type="text" name="direccion" id="direccion" placeholder="Dirección" required/>
                                </div>
                            </div>

                            <label class="col-sm-4 control-label">
                                Teléfono<font class="need-field">*</font>
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control margin-bottom" type="text" name="telefono" id="telefono" placeholder="Teléfono" required/>
                            </div>

                            <label class="col-sm-4 control-label">
                                Giro comercial<font class="need-field">*</font>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control margin-bottom" name="giro" id="giro" required>
                                    @foreach ($giros as $giro)
                                        <option value="{{ $giro->id}}">{{ $giro->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="col-sm-4 control-label">
                                Email<font class="need-field">*</font>
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control margin-bottom" type="email" name="email" id="email" placeholder="Email" required/>
                            </div>
                            <label class="col-sm-4 control-label">
                                Password<font class="need-field">*</font>
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control margin-bottom" type="password" name="password" id="password" placeholder="Password" id="password" required/>
                            </div>    
                            
                            <label class="col-sm-4 control-label">
                                Confirma el password<font class="need-field">*</font>
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control margin-bottom" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirma el password" title="ES necesario que el password sea similar" required/>
                            </div>
                                        
                            <label class="col-sm-4 control-label">
                                Codigo promotor<font class="optional-field">(Opcional)</font>
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control margin-bottom" type="text" name="cod_promotor" id="cod_promotor" placeholder="Codigo promotor" />
                            </div>
                            <div class="form-group">
                                <label class="col-sm-8 col-sm-offset-4 control-label">
                                    <input class="checkbox" type="checkbox" required>Acepto<a href="{{ url('terminosycondiciones')}}"> Términos y Condiciones </link>
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success col-sm-4 col-sm-offset-4">Registrarse</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection