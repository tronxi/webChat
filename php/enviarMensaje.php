<?php
	session_start();
	include 'datos.php';
	$con = mysqli_connect($host, $usuario, $contraseña); mysqli_select_db($con, $bd);

	$query = "insert into mensaje (nombre, texto, fecha, id_conversacion) values ('".$_SESSION['usuario']."', '".$_POST['mensaje']."', '".date('Y/m/d H:i:s')."', ".$_SESSION['conversacion'].")";
	mysqli_query($con, $query);

	$query = "insert into conversacion (estado) values(1) where id_conversacion = ".$_SESSION['conversacion']." and nombre in (select nombre from conversacion where id_conversacion = ".$_SESSION['conversacion'].") and nombre != '".$_SESSION['usuario']."'";
	mysqli_query($con, $query);
	mysqli_close($con);
?>
