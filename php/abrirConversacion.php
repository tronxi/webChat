<?php
	session_start();
	$_SESSION['conversacion'] = $_POST['conversacion'];
	header('Location: ../html/chat.php');
?>
	