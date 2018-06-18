addEventListener('load', inicializarEventos, false);

function inicializarEventos()
{
	buscar();
}
var conexion1;
var conexion2;
var conexion3;

function buscar()
{
	var url = '../php/buscarPersonas.php';
	conexion1 = new XMLHttpRequest(url);
	conexion1.onreadystatechange = procesarEventos;
	conexion1.open("GET", url, true);
	conexion1.send();
}

function abrirConversacion(nombre)
{
	var url = "../php/crearConversacion.php";
	conexion2 = new XMLHttpRequest();
	conexion2.onreadystatechange = procesarConversacion;
	conexion2.open('POST', url, true);
	conexion2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion2.send('persona=' + encodeURIComponent(nombre.id));
}

function procesarConversacion()
{
	if(conexion2.readyState == 4)
	{
		var resul = JSON.parse(conexion2.responseText);
		for(var i in resul)
		{
			guardarConversacion(resul[i].estado);
		}
	}
}
function guardarConversacion(conversacion)
{
	conexion3 = new XMLHttpRequest();
	conexion3.onreadystatechange = abrirChat;
	conexion3.open('POST', '../php/abrirConversacion.php', true);
	conexion3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion3.send('conversacion=' + encodeURIComponent(conversacion));
	console.log(conversacion);
}

function abrirChat()
{
	if(conexion3.readyState == 4)
	{
		window.location = "../html/chat.php";
	}
}

function procesarEventos()
{
	var busqueda = document.getElementById('personas');
	var busquedaHTML = "";
	if(conexion1.readyState == 4)
	{
		var busquedaJson = JSON.parse(conexion1.responseText);
		for(var i in busquedaJson)
		{
			busquedaHTML += "<div class='card mb-4 box-shadow'><div class='card-header'><h4 class='my-0 font-weight-normal'>" + busquedaJson[i].nombre + "</h4></div><div class='card-body'><button type='button' class='btn btn-lg btn-block btn-outline-primary' id=" + busquedaJson[i].nombre + " onclick='abrirConversacion(" + busquedaJson[i].nombre + ")'>hablar</button></div></div>";
		}
		personas.innerHTML = busquedaHTML;
	}
}
