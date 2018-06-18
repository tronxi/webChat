<?php
  session_start();
  include 'datos.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

  $query = "insert into mensaje (nombre, texto, fecha) values ('".$_POST['usuario']."', '".$_POST['mensaje']."', '".date('Y/m/d H:i:s')."')";
  mysqli_query($con, $query);
  mysqli_close($con);
?>
