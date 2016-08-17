@extends('layouts.empresas')
@include('includes.headerEmpresa')
@section('content')

		<link rel="stylesheet" href="/css/clockpicker.css" />
		<link rel="stylesheet" href="/css/bootstrap-clockpicker.css" />
        <link rel="stylesheet" href="/css/bootstrap-clockpicker.min.css" />
		<link rel="stylesheet" href="/css/jquery-clockpicker.css" />
		<link rel="stylesheet" href="/css/jquery-clockpicker.min.css" />
		<link rel="stylesheet" href="/css/pikaday.css">
		<script type="text/javascript" src="/js/clockpicker.js"></script>
		<script type="text/javascript" src="/js/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="/js/jquery-ui-1.11.1.js"></script>
		<script type="text/javascript" src="/js/jquery-ui.multidatespicker.js"></script>
		<script type="text/javascript" src="/js/jquery-clockpicker.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap-clockpicker.js"></script>
		<script type="text/javascript" src="/js/jquery-clockpicker.js"></script>
		<script type="text/javascript" src="/js/bootstrap-clockpicker.min.js"></script>
 
<script>
			Element.prototype.remove = function() {
    			this.parentElement.removeChild(this);
			}
			NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    			for(var i = this.length - 1; i >= 0; i--) {
        			if(this[i] && this[i].parentElement) {
            			this[i].parentElement.removeChild(this[i]);
        			}
    			}
			}
			

			

			var i=0;
			function deleteRest(nameDiv)
			{
				document.getElementById(nameDiv).remove();
			}
			function add(){ 
        			i++;
        			var node = document.createElement('div');        
					node.innerHTML = '<div class="row small-12 columns" id="divRest' + i + '"> \
										<div class="input-group small-8 columns"> \
  											<input class="input-group-field"  type="text"> \
  											<div class="input-group-button"> \
    											<input type="button"  class="button alert" value="Eliminar" onClick="deleteRest(\'divRest' + i + '\')"> \
  											</div> \
											</input> \
											</div> \
									</div>';       
        			document.getElementById('restContainer').appendChild(node);    
			}

			function addSucur(){ 
        			i++;
        			var node = document.createElement('div');        
					node.innerHTML = '<div class="row small-12 columns" id="divSucur' + i + '"> \
										<div class="input-group small-8 columns"> \
  											<input class="input-group-field"  type="text"> \
  											<div class="input-group-button"> \
    											<input type="button"  class="button alert" value="Eliminar" onClick="deleteRest(\'divSucur' + i + '\')"> \
  											</div> \
											</input> \
										</div> \
									</div>';       
        			document.getElementById('sucurContainer').appendChild(node);    
			}
	    </script>

<div class="row">
		<form class="small-centered  columns" method="POST" action="savePromo/{{$promo->id}}" enctype="multipart/form-data">
			<fieldset class="fieldset">
			@if (count($errors) > 0)
					<div class="row">
            			<ul>
                			@foreach($errors->all() as $error)
                    			<li>{{ $error }}</li>
                			@endforeach
            			</ul>
					</div>
        		@endif
			{!! csrf_field() !!}
			<!-- opcion -->
			<div class="horizontal-align large-6 medium-12 small-12 columns">
				<div class="row">
                    <div class="small-3 columns ahorrolabel">
                        <label class="text-right middle">
                        	Opción
                    		<font class="need-field">*</font>
                    	</label>
                    </div>
                    <div class="small-12 large-9 columns">
                    	<select id="tipo_promo" name="tipo_promo" required>
							@foreach ($tipo_promos as $tipo)
    							<option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
							@endforeach
                    	</select>
                	</div>
                </div>
			<!-- categorias -->
				
			<!-- descripcion -->
				<div class="row">
					<div class="small-3 columns ahorrolabel">
						<label class="text-right middle">
							Descripción
							<font class="need-field">*</font>
						</label>
					</div>
					<div class="small-12 large-9 columns">
						<textarea rows="5" id="descripcion" name="descripcion" placeholder="Descripcion " required></textarea>
					</div>
				</div>
				<!-- dias validos (calendario visible) -->
				<div class="row" >
					<div class="small-3 columns ahorrolabel">
						<label class="text-right middle" for="datepicker">
							Dias válidos
						</label>
					</div>
					<div class="small-12 large-9 columns">
						
						<div class="small-12 large-9 medium-10 columns" id="container">
						<input type="hidden" id="dias" name="dias">
						<script src="/js/pikaday.js"></script>
						<script>
							var picker = new Pikaday(
							{
								field: document.getElementById('dias'),
								firstDay: 1,
								minDate: new Date(),
								maxDate: new Date(2020, 12, 31),
								yearRange: [2000,2020],
        						bound: false,
        						container: document.getElementById('container'),
								multiple: true,
								onMultiSelect: function(dates) {
        							console.log(dates);
									document.getElementById('dias').value = dates;
									//alert('alerta: ' + picker.toString('YYYY-MM-DD'));
    							}
							});
						</script>	
					</div>	
				</div>
				<div class="row" >
					<div class="small-3 large-1 medium-2 columns"></div>
					<div class="small-3 large-1 medium-2 columns"></div>
					</div>
				</div>
			</div>
			<div class="horizontal-align large-6 medium-12 small-12 columns">
			
			<!-- horarios (timer) -->
			<div class="row">
				<div class="small-2 columns">
					<label class="text-left middle">
						Horarios
						<font class="need-field">*</font>
					</label>
				</div>
				<div class="small-5 columns">
					<div class="input-group clockpicker">
    					<input type="text" id="hinicia" name="hinicia" placeholder="Inicio" class="input-group-field" value="09:30">
						<span class="input-group-label">Inicia</span>
					</div>
				</div>
				<div class="small-5 columns">
					<div class="input-group clockpicker">
    					<input type="text" id="hfinal" name="hfinal" placeholder="Finaliza" class="input-group-field" value="18:00">
						<span class="input-group-label">Termina</span>
					</div>
				</div>
				<script type="text/javascript">
					$('.clockpicker').clockpicker({donetext: 'Listo'});
	            </script>
			</div>
			<!-- sucursales (un + ) dinamico -->
			<div class="row">
				<div class="small-12 columns ahorrolabel">
					<button class="small hollow button" type="button" onClick="addSucur()">
						Agregar sucursales
						<font class="need-field">*</font>
					</button>
				</div>
				
			</div>
			<div class="row" id="sucurContainer">
			</div>
			<!-- restricciones -->
			<div class="row">
				<div class="small-12 columns ahorrolabel">
					<button class="small hollow button" onClick="add()" type="button">
						Agregar restricciones
						<font class="need-field">*</font>
					</button>
				</div>
			</div>
			<div class="row" id="restContainer">
			</div>
			<!-- subir imagen -->
			<div class="row">
				<div class="small-5 columns">
				
					<label for="imagen" class="button">Subir imagen<font class="need-field">*</font></label>   
					<input type="file" id="imagen" name="imagen" class="show-for-sr"  accept=".png,.jpeg,jpeg" required>        
					
					
				</div>
				<div class="small-5 small-centered columns">
					<input value="Ver ejemplo" class= "small warning hollow button" type="button"/>
				</div>
			</div>
			<!-- btn ver ejemplo -->
			<div class="row">
				<div class="small-centered columns large-12">
					<button type="submit" class="success button small-12">
						Envíar
					</button>
				</div>
			</div>
			</div>
			</fieldset>
		</form>
	</div>
@endsection