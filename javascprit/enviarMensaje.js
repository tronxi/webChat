addEventListener('load', inicializarEventos, false);
function inicializarEventos()
{
  var formulario = document.getElementById('enviarF');
  formulario.addEventListener('submit', enviarMensaje, false);
}

function enviarMensaje(e)
{
  e.preventDefault();
  if(document.getElementById('mensaje').value.localeCompare("") != 0)
  {
    enviar();
  }
}

function getDatos()
{
  var cad='';
  var mensaje = document.getElementById('mensaje').value;
  cad = 'mensaje='+encodeURIComponent(mensaje);
  return cad;
}

var conexion;

function enviar()
{
  conexion = new XMLHttpRequest();
  conexion.onreadystatechange = procesarEventos;
  conexion.open('POST','../php/enviarMensaje.php', true);
  conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion.send(getDatos());
}

function procesarEventos()
{
  var resultados = document.getElementById('mensaje');
  if(conexion.readyState == 4)
  {
    resultados.value = "";
  }
}
