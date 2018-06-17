function guardarConversacion(conversacion)
{
	conexion2 = new XMLHttpRequest();
	conexion2.onreadystatechange = null;
  	conexion2.open('POST','../php/abrirConversacion.php', true);
  	conexion2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  	conexion2.send('conversacion=' + encodeURIComponent(conversacion));
}