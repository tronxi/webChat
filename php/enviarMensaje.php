<?php
  session_start();
  include 'contraseñas.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

  $query = "insert into mensaje (nombre, texto, fecha, id_conversacion)
   values ('".$_SESSION['usuario']."', '".$_POST['mensaje']."', '".date('Y/m/d H:i:s')."', ".$_SESSION['conversacion'].")";
  mysqli_query($con, $query);
  mysqli_close($con);
?>
