addEventListener('load', inicializarEventos, false);
function inicializarEventos()
{

}
var actualizar = setInterval(function(){mostrarDatos()}, 500);
function mostrarDatos()
{
  var url = "../php/mostrarMensaje.php";
  mostrar(url);
}

var conexion1;

function mostrar(url)
{
  conexion1 = new XMLHttpRequest(url);
  conexion1.onreadystatechange = escribir;
  conexion1.open("GET", url, true);
  conexion1.send();
}

function escribir()
{
  var conversacion = document.getElementById('conversacion');
  if(conexion1.readyState == 4)
  {
    conversacion.value = utf8_decode(conexion1.responseText);
    conversacion.scrollTop = conversacion.scrollHeight;
  }
}
