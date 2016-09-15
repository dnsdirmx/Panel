var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  }
  else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

function seleccionaEstado()
{
  $selector = document.getElementById("estado");
  var select = document.getElementById("ciudad");
  var length = select.options.length;
  for(i = select.options.length - 1 ; i >= 0 ; i--)
    {
        select.remove(i);
    }
//alert('nose');
  $.getJSON( "get-ciudades/" + $selector.value , function( data ) {
      var items = [];
    
      $.each( data, function( key, val ) {
        opt = document.createElement("option");
        opt.value = val.cve_mun;
        opt.textContent = val.nom_mun;
        select.appendChild(opt);
      });
    });

  
}

function obtienePromocion(idpromo)
{
  $.getJSON( "promocion/" + idpromo , function( data ) {
      var items = [];
      var id = 0;
      console.log("datos: " + JSON.stringify(data));
      $.each( data, function( key, val ) {
        //"id"
        //"empresa_id"
        //"tipo_promo_id"
        //"imagenfullpath"
        //"created_at"
        //"updated_at"
        if("dias".localeCompare(key) == 0)
        {
          
          var picker = new Pikaday(
            { 
              field: document.getElementById('ndias'),
	            firstDay: 1,
	            minDate: new Date(2016, 7, 28),
	            maxDate: new Date(2020, 12, 31),
	            yearRange: [2000,2020],
              bound: false,
              container: document.getElementById('pickadaydiv'),
	            multiple: true,
	          });
          var arr = new Array();
          val.forEach(function (element){
           //$("#ndias").val(element.dia + "," +  $("#ndias").val());
            $("#ndias").val(element.dia);
            picker.setDate($("#ndias").val());
            //picker.setDate("\"" + element.dia + "\"");
            console.log("ndias.val = " + $("#ndias").val());
          });
          picker.setDate($("#ndias").val());
          picker.gotoToday();
        }
        if("condiciones".localeCompare(key) == 0)
        {
          val.forEach(function(element)
          {
            $("#pcondiciones").text(element.nombre);
          });
        }
        if("sucursales".localeCompare(key) == 0)
        {
          ;
          while (document.getElementById("divsucursales").hasChildNodes()) {
            document.getElementById("divsucursales").removeChild(document.getElementById("divsucursales").lastChild);
          }

          console.log("hola: " + val);
          //alert("sucursal: " + val);
          val.forEach(function(element) {
            console.log("Elemento: " + JSON.stringify(element));
            var div = document.createElement('div');
            div.className = "row";
            div.innerHTML = "<strong><p >" + element.nombre + "</p></strong>"
            document.getElementById("divsucursales").appendChild(div);
            //alert(JSON.stringify(element))
          }, this);

        }
        if("id".localeCompare(key) == 0)
        {
          id = val;
        }
        if("imagenfullpath".localeCompare(key) == 0)
        {
          $('#promoimg').attr('src','/promocion/' + id + '/imagen');
        }
        if("hinicia".localeCompare(key) == 0)
        {
          $("#hinicio").text(val);
        }
        if("hfinaliza".localeCompare(key) == 0)
        {
          $("#hfinaliza").text(val);
        }
        if("estatus".localeCompare(key) == 0)
        {
          if("guardado".localeCompare(val) == 0)
            $("#estatus").text("Pendiente");
          else
            $("#estatus").text(val);
        }
        if("nompromo".localeCompare(key) == 0)
        {
          $('#promonombre').text(val);
        }
        //"nompromo"
        if("descripcion".localeCompare(key) == 0)
        {
          $('#descripcion').text(val);
        }
        if("promo_tipo".localeCompare(key) == 0)
         {
            //var promo_tipo = document.getElementById("tipo");
            //promo_tipo.text(val);
            $('#tipo').text(val);
         }
        if("created_at".localeCompare(key) == 0)
        {
          var mes = new Array();
          mes[0] = "Enero";
          mes[1] = "Febrero";
          mes[2] = "Marzo";
          mes[3] = "Abril";
          mes[4] = "Mayo";
          mes[5] = "Junio";
          mes[6] = "Julio";
          mes[7] = "Agosto";
          mes[8] = "Septiembre";
          mes[9] = "Octubre";
          mes[10] = "Noviembre";
          mes[11] = "Diciembre";
          var formatted = new Date(val);
          $('#fechacreacion').text(formatted.getDate() + " de " + mes[formatted.getMonth()] + " de " + formatted.getFullYear());
        }
        //"sucursales"
        //"dias"
        //"condiciones"

      });
      $('#promocionview').modal('show')
    });
}