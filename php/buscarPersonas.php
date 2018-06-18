<?php
  session_start();
  header('Content-Type: text/html; charset=utf-8');
  include 'contraseñas.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

  $query = "select nombre from usuario where nombre !='".$_SESSION['usuario']."'";
  $resul = mysqli_query($con, $query);
  $objJson = array();
  while($fila = mysqli_fetch_array($resul))
  {
    $objJson[] = array('nombre' => $fila['nombre']);
  }
  mysqli_close($con);

  echo json_encode($objJson);
?>
