<?php
  $include 'datos.php';
  session_start();
  header('Content-Type: text/html; charset=utf-8');

  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

  $query = "select nombre, texto, fecha from mensaje where id_conversacion = ".$_SESSION['conversacion']."";
  $resul = mysqli_query($con, $query);

  while($fila = mysqli_fetch_array($resul))
  {
    echo $fila['nombre']."- ".$fila['fecha'].": ".$fila['texto']."\n";
  }
  mysqli_close($con);
?>
