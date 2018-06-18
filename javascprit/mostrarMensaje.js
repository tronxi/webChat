addEventListener('load', inicializarEventos, false);

function inicializarEventos()
{}
var actualizar = setInterval(function ()
{
	mostrarDatos()
}, 500);

function mostrarDatos()
{
	var url = "../php/mostrarMensajeJson.php";
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
		var mensajesJson = JSON.parse(conexion1.responseText);
		var mensajes = "";
		for(var i in mensajesJson)
		{
			mensajes += mensajesJson[i].nombre + "- " + mensajesJson[i].fecha + ": " + mensajesJson[i].texto + "\n";
			console.log(mensajes);
			conversacion.value = conexion1.mensajes;
			conversacion.scrollTop = conversacion.scrollHeight;
		}
	}
}
