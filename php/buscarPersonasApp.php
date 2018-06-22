<?php
  session_start();
  header('Content-Type: text/html; charset=utf-8');
  include 'datos.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

  $query = "select nombre, id_conversacion, estado from usuario where nombre !='".$_POST['usuario']."'";
  $resul = mysqli_query($con, $query);
  $objJson = array();
  while($fila = mysqli_fetch_array($resul))
  {
    $objJson[] = array('nombre' => $fila['nombre'],
					  'idConversacion' => $fila['id_conversacion'],
					  'estado' => $fila['estado']);
  }
  mysqli_close($con);

  echo json_encode($objJson);
?>
