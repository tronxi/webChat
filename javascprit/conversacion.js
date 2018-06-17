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

function guardarConversacion(conversacion)
{
	conversaciones.innerHTML = "<?php session_start(); $_SESSION['conversacion'] = "+ conversacion +";header('Location: ../html/chat.php'); ";
}

function procesarEventos()
{
	if(conexion.readyState == 4)
	{
		var conversacionJson = JSON.parse(conexion.responseText);
		var conversacionHTML = "";
		for(var i in conversacionJson)
		{
			conversacionHTML += "<div class='card-deck mb-3 text-center'><div class='card mb-4 box-shadow'><div class='card-header'><h4 class='my-0 font-weight-normal'>" + conversacionJson[i].nombre + "</h4></div><div class='card-body'><button type='button' class='btn btn-lg btn-block btn-outline-primary' id="+conversacionJson[i].idConversacion+">hablar</button></div></div></div>";
			document.getElementById(conversacionJson[i].idConversacion.toString()).addEventListener('click', function(){guardarConversacion(conversacionJson[i].idConversacion.toString())}, false);
		}
		conversaciones.innerHTML = conversacionHTML;
	}
	else
	{
		//
	}
}
