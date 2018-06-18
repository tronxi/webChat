addEventListener('load', inicializarEventos, false);

function inicializarEventos()
{
	var conversaciones = document.getElementById('conversaciones');
	//enviarMensaje();
}
var actualizar = setInterval(function()
{
  enviarMensaje()
}, 500);

function enviarMensaje()
{
	url = "../php/buscarConversacion.php";
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

function guardarConversacion(conversacion)
{
	conexion2 = new XMLHttpRequest();
	conexion2.onreadystatechange = abrirChat;
	conexion2.open('POST', '../php/abrirConversacion.php', true);
	conexion2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	conexion2.send('conversacion=' + encodeURIComponent(conversacion));
	console.log(conversacion);
}

function abrirChat()
{
	if(conexion2.readyState == 4)
	{
		window.location = "../html/chat.php";
	}
}

function procesarEventos()
{
	if(conexion.readyState == 4)
	{
		console.log("actualizado");
		var conversacionJson = JSON.parse(conexion.responseText);
		var conversacionHTML = "";
		for(var i in conversacionJson)
		{
			conversacionHTML += "<div class='card mb-4 box-shadow chat '><div class='card-header'><h4 class='my-0 font-weight-normal'>" + conversacionJson[i].nombre + "</h4></div><div class='card-body'><button type='button' class='btn btn-lg btn-block btn-outline-primary' id=" + conversacionJson[i].idConversacion.toString() + " onclick='guardarConversacion(" + conversacionJson[i].idConversacion.toString() + ")'>hablar</button></div></div>";
		}
		conversaciones.innerHTML = conversacionHTML;
	}
	else
	{
		//
	}
}
