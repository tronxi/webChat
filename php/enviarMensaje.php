<?php
	session_start();
	include 'datos.php';
	$con = mysqli_connect($host, $usuario, $contraseña); mysqli_select_db($con, $bd);

	$query = "insert into mensaje (nombre, texto, fecha, id_conversacion) values ('".$_SESSION['usuario']."', '".$_POST['mensaje']."', '".date('Y/m/d H:i:s')."', ".$_SESSION['conversacion'].")";
	mysqli_query($con, $query);

	$query = "UPDATE conversacion
			SET
				estado = estado + 1
			WHERE
				id_conversacion = ".$_SESSION['conversacion']."
					AND nombre = ".$_SESSION['usuario']."";
	mysqli_query($con, $query);
	mysqli_close($con);
?>
