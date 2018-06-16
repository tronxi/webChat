<?php
  session_start();
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");

  $query = "insert into mensaje (nombre, texto, fecha) values ('".$_SESSION['usuario']."', '".$_POST['mensaje']."', '".date('Y/m/d H:i:s')."')";
  mysqli_query($con, $query);
  mysqli_close($con);
?>
