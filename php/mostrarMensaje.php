<?php
  header('Content-Type: text/html; charset=utf-8');
  session_start();
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");

  $query = "select nombre, texto, fecha from mensaje";
  $resul = mysqli_query($con, $query);
  while($fila = mysqli_fetch_array($resul))
  {
    echo htmlentities($fila['nombre']).": ".htmlentities($fila['texto']." - ".$fila['fecha']."\n");
  }
  mysqli_close($con);
?>