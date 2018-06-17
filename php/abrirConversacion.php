<?php
	session_start();
	$_SESSION['conversacion'] = $_POST['conversacion'];
	header("Location: /webChat/html/chat.php");
?>
