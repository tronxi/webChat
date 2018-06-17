<?php
	session_start();
	$_SESSION['conversacion'] = $_POST['conversacion'];
	console.log("hola");
	header("Location: ../html/chat.php");
?>
