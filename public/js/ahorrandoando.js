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