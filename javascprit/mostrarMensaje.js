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


var conexion1;

function enviar(url)
{
  conexion1 = new XMLHttpRequest(url);
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open("GET", url, true);
  conexion1.send();
}

function procesarEventos()
{
  var resultados = document.getElementById('conversacion');
  if(conexion1.readyState == 4)
  {
    resultados.value = conexion1.responseText;
  }
  else
  {
  }
}
