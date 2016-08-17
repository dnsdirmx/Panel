@extends('layouts.empresas')

@include('includes.headerAccesoEmp')

@section('content')
    <div class="row" >
            <div class="separator"></div>
            <form class="small-centered columns" method="POST" action="{{ url('/empresa-register') }}">
                <fieldset class="fieldset">

                {{ csrf_field() }}
                <div class="row">
                    @if(count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="ahorrando-form-content row">
                    <div class="horizontal-align large-6 medium-6 small-12 columns">
                        <div class="row">
                            <div class="small-4 columns ahorrolabel">
                                <label class=" middle">
                                    Nombre del contacto
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <input type="text" name="nombre_contacto" id="nombre_contacto" placeholder="Nombre del contacto" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-4 columns ahorrolabel">
                                <label class=" middle">
                                    Nombre de la empresa
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <input type="text" name="name" id="name" placeholder="Nombre de la empresa" required/>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="small-4 columns ahorrolabel">
                                <label class=" middle">
                                    Estado
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <select onChange="seleccionaEstado()" name="estado" id="estado" required>
                                    @foreach ($estados as $estado)
                                        <option  value="{{ $estado->cve_ent}}">{{ $estado->nom_ent }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="small-4 columns ahorrolabel">
                                <label class=" middle">
                                    Ciudad
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <!-- <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required/> -->
                                <select name="ciudad" id="ciudad" required>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-4 columns ahorrolabel">
                                <label class=" middle">
                                    Dirección
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <input type="text" name="direccion" id="direccion" placeholder="Dirección" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-4 columns ahorrolabel">
                                <label class=" middle">
                                    Teléfono
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required/>
                            </div>
                        </div>
                        
                    </div>
                    <div class="horizontal-align large-6 medium-6 small-12 columns ">
                        <div class="row">
                            <div class="small-4 columns ahorrolabel">
                                <label class="middle">
                        	        Giro comercial
                    		        <font class="need-field">*</font>
                    	        </label>
                            </div>
                            <div class="small-12 large-8 columns">
                    	        <select name="giro" id="giro" required>
                                    @foreach ($giros as $giro)
                                        <option value="{{ $giro->id}}">{{ $giro->nombre }}</option>
                                    @endforeach
                    	        </select>
                	        </div>
                        </div>
                        <div class="row">
                            <div class="small-4 columns ahorrolabel">
                                <label class=" middle">
                                    Email
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <input type="email" name="email" id="email" placeholder="Email" required/>
                            </div>
                        </div>                        
                        <div class="row">

                            <div class="small-4 columns ahorrolabel">
                                <label class=" middle">
                                    Password
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <input type="password" name="password" id="password" placeholder="Password" id="password" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-4 columns ahorrolabel">
                                <label class=" middle">
                                    Confirma el password
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirma el password" title="ES necesario que el password sea similar" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-12 large-4 columns ahorrolabel">
                                <label class=" middle">
                                    Codigo promotor
                                    <font class="optional-field">(Opcional)</font>
                                </label>
                            </div>
                            <div class="small-12 large-8 columns">
                                <input type="text" name="cod_promotor" id="cod_promotor" placeholder="Codigo promotor" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-12 large-4 columns ahorrolabel"></div>
                            <div class="small-12 large-6 columns">
                                <input type="checkbox" name="vehicle" value="Car" required>
                                <label class="middle">
                                    Acepto
                                    <a href="{{ url('terminosycondiciones')}}"> terminos y condiciones </link>
                                    <font class="need-field">*</font>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-3 columns"></div>
                            <div class="small-3 columns"></div>
                            <button type="submit" class="success button small-12 medium-12 large-8 small-centered columns">Registrarse</button>
                        </div>
                    </div>
                </div>
                </fieldset>
            </form>
        </div>
@endsection