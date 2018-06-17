<?php
session_start();
	$con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  	mysqli_select_db($con, "chat");

  $query = "insert into usuario (nombre, contra) values ('mecagoentododosveces','".sha1( 'mecagoentodo')."')";
  $resul = mysqli_query($con, $query);
  mysqli_close($con);

	/*
    $_SESSION['conversacion'] = $_POST['conversacion'];
	$cont = file_get_contents("../html/chat.php"); 
	echo $cont;*/
    //header("Location: ../html/chat.php");
?>
