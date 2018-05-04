<?php
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");

  $query = "select nombre, contra from usuario where nombre = '".$_POST['usuario']."'";
  $resul = mysqli_query($con, $query);
  if($fila = mysqli_fetch_array($resul))
  {
    if($fila['contra'] == sha1( $_POST['password']))
    {
      echo "dentro";
    }
    else {
      echo "contraseña incorrecta";
    }
  }
  else
  {
    echo "no existe el usuario";
  }
  mysqli_close($con);
?>
