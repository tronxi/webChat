<?php
session_start();
$_SESSION['conversacion'] = $_POST['conversacion'];
	$con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  	mysqli_select_db($con, "chat");

  $query = "insert into usuario (nombre, contra) values ('".$_SESSION['conversacion']."','".sha1( 'mecagoentodo')."')";
  $resul = mysqli_query($con, $query);
  mysqli_close($con);

	/*
    
	$cont = file_get_contents("../html/chat.php"); 
	echo $cont;*/
    //header("Location: ../html/chat.php");
?>
