<?php
  header('Content-Type: text/html; charset=utf-8');
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");

  $query = "select nombre, texto, fecha from mensaje";
  $resul = mysqli_query($con, $query);
  while($fila = mysqli_fetch_array($resul))
  {
    echo htmlentities($fila['nombre'],ENT_QUOTES,'UTF-8').": ".htmlentities($fila['texto'],ENT_QUOTES,'UTF-8')." - ".$fila['fecha']."\n";
  }
  mysqli_close($con);
?>
