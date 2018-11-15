<?php
  include 'datos.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);
  $query = "update usuario set token = null where nombre = '".$_POST['usuario']."'";
  $resul = mysqli_query($con, $query);
  mysqli_close($con);
?>