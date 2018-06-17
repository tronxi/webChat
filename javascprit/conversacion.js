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
	var url2 = "../php/abrirConversacion.php";
	conexion.onreadystatechange = null;
  	conexion.open('POST',url2, true);
  	conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  	conexion.send('conversacion=' + encodeURIComponent(conversacion));
}

function procesarEventos()
{
	if(conexion.readyState == 4)
	{
		var conversacionJson = JSON.parse(conexion.responseText);
		var conversacionHTML = "";
		for(var i in conversacionJson)
		{
			conversacionHTML += "<div class='card-deck mb-3 text-center'><div class='card mb-4 box-shadow'><div class='card-header'><h4 class='my-0 font-weight-normal'>" + conversacionJson[i].nombre + "</h4></div><div class='card-body'><button type='button' class='btn btn-lg btn-block btn-outline-primary' id=" + conversacionJson[i].idConversacion.toString() + " onclick='guardarConversacion("+conversacionJson[i].idConversacion+")'>hablar</button></div></div></div>";
			/*var boton = document.getElementById(conversacionJson[i].idConversacion.toString());
			console.log(conversacionJson[i].idConversacion.toString());
			if(boton)
			{
				console.log("ola");
				boton.addEventListener('click', function ()
				{
					guardarConversacion(conversacionJson[i].idConversacion.toString())
				}, false);
			}*/
		}
		conversaciones.innerHTML = conversacionHTML;
	}
	else
	{
		//
	}
}
