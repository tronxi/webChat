<?php
  session_start();
  header('Content-Type: text/html; charset=utf-8');
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");
  $query = "select nombre from usuario where nombre != ".$_SESSION['usuario']."";
  $resul = mysqli_query($con, $query);
  $objJson = array();
  while($fila = mysqli_fetch_array($resul))
  {
    objJson[] = array('nombre' => $fila['nombre']);
  }
  mysqli_close($con);
  echo json_encode($objJson);
?>
