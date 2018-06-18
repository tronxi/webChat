<?php
  include 'datos.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

  $query = "select nombre, contra from usuario where nombre = '".$_POST['usuario']."'";
  $resul = mysqli_query($con, $query);
  if($fila = mysqli_fetch_array($resul))
  {
    if($fila['contra'] == sha1( $_POST['password']))
    {
      session_start();
      $_SESSION['usuario'] = $_POST['usuario'];
      echo "ok";
    }
    else {
      echo "contraseñaIncorrecta";
    }
  }
  else
  {
    echo "noExisteUsuario";
  }
  mysqli_close($con);
?>
