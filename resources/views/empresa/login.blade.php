@extends('layouts.empresas')

@include('includes.headerAccesoEmp')

@section('content')
<link rel="stylesheet" href="/css/empresa.css" />
<link rel="stylesheet" href="/css/panel.css" />
<div class="container-fluid">
	<div class="row" >
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
			<div class="panel">
				<div class="panel-heading nav navbar-inverse">
						<ul class="nav navbar-nav">
                  			<li>
								Iniciar Sesión
							</li>
						</ul>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('empresa-login') }}">
						<fieldset >
							@if (count($errors) > 0)
								<div>
									<ul>
										@foreach($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							{!! csrf_field() !!}
							<div class="form-group">
								<label class="col-sm-3 control-label">
									Email<font class="need-field">*</font>
								</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" placeholder="Email" id="email" name="email" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">
									Contraseña<font class="need-field">*</font>
								</label>
								<div class="col-sm-9">
									<input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" title="Es necesario que la contraseña sea similar" required/>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-3 ">
									<button class="btn btn-success col-sm-9"  type="submit">
										Iniciar Sesión
									</button>
								</div>
							</div>
						</fieldset>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection