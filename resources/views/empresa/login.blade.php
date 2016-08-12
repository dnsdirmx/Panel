@extends('layouts.empresas')

@include('includes.headerAccesoEmp')

@section('content')


<div class="row" >
        @if ($errors->has('form'))
            <span class="help-block">
            	<strong>{{ $errors->first('name') }}</strong>
        	</span>
        @endif
		<form class="small-centered large-4 medium-6 small-10 columns" role="form" method="POST" action="{{ route('empresa-login') }}">
			<fieldset class="fieldset">
				{!! csrf_field() !!}
				<div class="row">
                        		<div class="small-4 columns ahorrolabel">
                                		<label class="text-right middle">
                                    			Email
                                    			<font class="need-field">*</font>
                                		</label>
                            		</div>
                            		<div class="small-12 large-8 columns">
                                		<input type="email" placeholder="Email" id="email" name="email" required/>
                            		</div>
                        	</div>
				<div class="row">
                            		<div class="small-4 columns ahorrolabel">
                                		<label class="text-right middle">
                                    			Password
                                    			<font class="need-field">*</font>
                                		</label>
                            		</div>
                            		<div class="small-12 large-8 columns">
                                		<input type="password" id="password" name="password" placeholder="Password" title="ES necesario que el password sea similar" required/>
                            		</div>
                        	</div>
				<div class="row">
					<div class="small-centered columns large-8">
						<button type="submit" class="success button small-12">
							Iniciar Sesión
						</button>
					</div>
                        	</div>
			</fieldset>
			
		</form>
        </div>

@endsection