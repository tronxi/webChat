<?php
	session_start();
	$_SESSION['conversacion'] = $_POST['conversacion'];
	console.log("hola");
	header("Location: ../html/chat.php");
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
?>
