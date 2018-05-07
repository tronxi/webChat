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
  var bajar = true;
  if(conexion1.readyState == 4)
  {
    if(conversacion.scrollTop == conversacion.scrollHeight)
    {
      bajar = true;
    }
    else
    {
      bajar = false;
    }
    conversacion.value = conexion1.responseText;
    console.log(conversacion.scrollTop);
    if(bajar)
    {
      conversacion.scrollTop = conversacion.scrollHeight;
    }
  }
}
