<?php
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");

  $query = "select nombre, contra from usuario where nombre = '".$_POST['usuario']."'";
  $resul = mysqli_query($con, $query);
  if($fila = mysqli_fetch_array($resul))
  {
    echo "yaExisteUsuario";
  }
  else
  {
    $query = "insert into usuario (nombre, contra) values ('".$_POST['usuario']."','".sha1( $_POST['password'])."')";
    mysqli_query($con, $query);
    mysqli_close($con);
    echo "ok";
  }
  mysqli_close($con);
?>
