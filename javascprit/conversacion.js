addEventListener('load', inicializarEventos, false);

function inicializarEventos()
{
	var conversaciones = document.getElementById('conversaciones');
	enviarMensaje()
}

function enviarMensaje()
{
	url = "../php/conversacion.php";
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
	if(conexion.readyState == 4)
	{
		var conversacionJson = JSON.parse(conexion.responseText);
		for(var i in conversacionJson)
		{
			console.log(conversacionJson[i].nombre);
		}
		conversaciones.innerHTML = conversacionJson.nombre;
		console.log("hola");
	}
	else
	{
		//
	}
}
