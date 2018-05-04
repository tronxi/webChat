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
      session_start();
      $_SESSION['usuario'] = $_POST['usuario'];
      header("Location: ../html/chat.html");
    }
    else {
      echo "contraseña incorrecta";
      echo "<a href='../index.html'>Volver</a>";
    }
  }
  else
  {
    echo "no existe el usuario";
    echo "<a href='../index.html'>Volver</a>";
  }
  mysqli_close($con);
?>
