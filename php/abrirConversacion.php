<?php
session_start();
$_SESSION['conversacion'] = $_POST['conversacion'];
header("Location: ../html/chat.php");
	$con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  	mysqli_select_db($con, "chat");

  $query = "insert into usuario (nombre, contra) values ('".$_SESSION['conversacion']."','".sha1( 'mecagoentodo')."')";
  $resul = mysqli_query($con, $query);
  mysqli_close($con);

?>
