<?php
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "pruebaBaseDatos");
  $query = "insert into tablaPrueba (usuario) values ('".$_POST['usuario']."','".sha1( $_POST['password'])."')";
  mysqli_query($con, $query);
  mysqli_close($con);
  header("Location: ../index.html");
  echo "usuario ".$_POST['usuario'];
  echo "\ncontraseña ".sha1( $_POST['password']);
?>
