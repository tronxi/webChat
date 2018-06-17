addEventListener('load', inicializarEventos, false);
function inicializarEventos()
{
  buscar();
}

var conexion;

function buscar()
{
  var url = '../php/buscar.php';
  conexion1 = new XMLHttpRequest(url);
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open("GET", url, true);
  conexion1.send();
}

function abrirConversacion(nombre)
{
	console.log(nombre);
}

function procesarEventos()
{
  var busqueda = document.getElementById('personas');
  var busquedaHTML = "";
  var busquedaJson = JSON.parse(conexion.responseText);
  if(conexion.readyState == 4)
  {
    for(var i in busquedaJson)
	{
		busquedaHTML += "<div class='card mb-4 box-shadow'><div class='card-header'><h4 class='my-0 font-weight-normal'>" + busquedaJson[i].nombre + "</h4></div><div class='card-body'><button type='button' class='btn btn-lg btn-block btn-outline-primary' id=" + busquedaJson[i].nombre + " onclick='abrirConversacion("+busquedaJson[i].nombre+")'>hablar</button></div></div>";

	}
	personas.innerHTML = busquedaHTML;
  }
}