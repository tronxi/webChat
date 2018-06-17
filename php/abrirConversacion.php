<?php
	session_start();
    $_SESSION['conversacion'] = $_POST['conversacion'];
	$cont = file_get_contents("../html/chat.php"); 
	echo $cont;
    //header("Location: ../html/chat.php");
?>
