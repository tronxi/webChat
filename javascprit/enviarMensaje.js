addEventListener('load', inicializarEventos, false);
function inicializarEventos()
{
  var formulario = document.getElementById('enviarF');
  formulario.addEventListener('submit', enviarMensaje, false);
}

function eviarMensaje(e)
{
  e.preventDefault();
  eviar();
}

function getDatos()
{
  var cad='';
  var mensaje = document.getElementById('mensaje').value;
  cad = 'mensaje'+encodeURIComponent(mensaje);
  return cad;
}

var conexion;

function enviar()
{
  conexion = new XMLHttpRequest();
  conexion.onreadystatechange = procesarEventos;
  conexion.open('POST','../php/enviarMensaje.php', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(getDatos());
}

function procesarEventos()
{
  var resultados = document.getElementById('mensaje');
  if(conexion.readyState == 4)
  {
    resultados.value = "enviando";
  }
  else
  {
    resultados.value = "";
  }
}
