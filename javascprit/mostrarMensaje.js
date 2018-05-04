addEventListener('load', inicializarEventos, false);
function inicializarEventos()
{

}
var actualizar = setInterval(function(){mostrarDatos()}, 500);
function mostrarDatos()
{
  var url = "../php/mostrarMensaje.php";
  enviar(url);
}


var conexion;

function enviar(url)
{
  conexion = new XMLHttpRequest(url);
  conexion.onreadystatechange = procesarEventos;
  conexion.open("GET", url, true);
  conexion.send();
}

function procesarEventos()
{
  var resultados = document.getElementById('conversacion');
  if(conexion.readyState == 4)
  {
    resultados.value = conexion.responseText;
  }
  else
  {
  }
}
