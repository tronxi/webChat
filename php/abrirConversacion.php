<?php
	session_start();
	$_SESSION['conversacion'] = $_POST['conversacion'];
	header("location: ../html/registro.html");
?>
