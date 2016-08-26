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

function createSurcursal(nameDiv,nameInput,idEmpresa)
{
    var hiddenIdPromo = document.getElementById("idPromo");
  	var select = document.getElementById("sucursales");
	
    var values = $('#sucursales').val();
	
    var length = select.options.length;
    for(i = select.options.length - 1 ; i >= 0 ; i--)
    {
        select.remove(i);
    }
	
    var inputId = document.getElementById(nameInput);
	$.get('/add-sucursales/' + hiddenIdPromo.value + '/' + inputId.value, function( data ) {
  	    var items = [];
        $.each( data, function( key, val ) {
            opt = document.createElement("option");
        	opt.value = val.id;
			if(values != null)
			{
			    for(i = 0; i < (values.length); i++)
				{
				    if(opt.value == values[i])
					    opt.selected = true;
				}
			}
        	opt.textContent = val.nombre;
        	select.appendChild(opt);
      	});
	});
	document.getElementById(nameDiv).remove();
}

function add(){ 
    i++;
    var node = document.createElement('div');        
	node.innerHTML = '<div class="form-group " id="divRest' + i + '"> \
						<div class="input-group col-sm-9 col-sm-offset-3">\
							<input class="form-control restricciones" placeholder="Condicion"  type="text"/>\
							<span class="input-group-btn ">\
								<input type="button"  class="btn btn-danger" value="Eliminar" onClick="deleteRest(\'divRest' + i + '\')"> \
							</span>\
						</div>\
					  </div>';
    document.getElementById('restContainer').appendChild(node);    
}

function addSucur(){ 
    i++;
    var node = document.createElement('div');  
	node.setAttribute("class","form-group");
	node.id = 'divSucur' + i;
	//<span class="input-group-btn ">\
	//						<input type="button"   class="btn btn-success" value="Agregar" onClick="createSurcursal(\'divSucur' + i + '\',\'inputSucur' + i + '\',\'{{$promo->id}}\')"> \
  	//					</span>\
	
	node.innerHTML = '<div class="input-group col-sm-12"> \
						<input type="text" placeholder="Dirección" class="col-xs-8 form-control sucursales" id="inputSucur' + i + '"  > \
    					<span class="input-group-btn ">\
							<input type="button"  class="btn btn-danger" value="Eliminar" onClick="deleteRest(\'divSucur' + i + '\')"> \
						</span>\
					</div>';       
    document.getElementById('sucurContainer').appendChild(node);    
}

function validaCampos()
{
    var selected = new Array();
	/*
	var tnl = document.getElementById("sucursales");
    for(i=0;i<tnl.length;i++){
        if(tnl.options[i].selected == true){
        //alert(tnl.options[i].value);
		    selected.push(tnl.options[i].value);
        }
    }
	*/
	var hdias = document.getElementById("dias");
	if(hdias.value == "")
	{
	    var node = document.createElement('li');        
		node.innerHTML = 'Debes seleccionar los dias de promocion';  
		document.getElementById('diverror').appendChild(node);
		return false;
	}
	var arrSucur = new Array();
	var inputsSuc = $(".sucursales");
	if(inputsSuc.length <= 0)
	{
		var node = document.createElement('li');        
		node.innerHTML = 'Indica al menos una sucursal';  
		document.getElementById('diverror').appendChild(node);
		return false;
	}
	for(var i = 0; i < inputsSuc.length; i++){
	    arrSucur.push('\"' + $(inputsSuc[i]).val() + '\"');
	}
	var hsucursales = document.getElementById("hsucursales");
	hsucursales.value = arrSucur.toString();

	var arrRest = new Array();
	var inputs = $(".restricciones");
	//if(inputs.length <= 0)
	//{
	//	var node = document.createElement('li');        
	//	node.innerHTML = 'Indica al menos una condicion';  
	//	document.getElementById('diverror').appendChild(node);
	//	return false;
	//}
	for(var i = 0; i < inputs.length; i++){
	    arrRest.push('\"' + $(inputs[i]).val() + '\"');
	}
	var hrestricciones = document.getElementById("hrestricciones");
	hrestricciones.value = arrRest.toString();

	return true;
}

$("#sucursales").mousedown(function(e){
    e.preventDefault();
    var select = this;
    var scroll = select.scrollTop;
    e.target.selected = !e.target.selected;
    setTimeout(function(){select.scrollTop = scroll;}, 0);
    $(select).focus();
}).mousemove(function(e){e.preventDefault()});


var picker = new Pikaday({
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
    }
});


$('#guardarForm').submit(function() {
  return validaCampos();
});
$('.clockpicker').clockpicker({donetext: 'Listo'});

