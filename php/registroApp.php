<?php
  include 'contraseñas.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

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
