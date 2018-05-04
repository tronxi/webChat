<?php
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");

  $query = "select nombre, contra from usuario where nombre = '".$_POST['usuario']."'";
  $resul = mysqli_query($con, $query);
  if($fila = mysqli_fetch_array($resul))
  {
    echo "<!DOCTYPE html>
    <html>
      <head>
        <meta charset='utf-8'>
        <title>WebChat</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
        <link href='../css/chat.css' rel='stylesheet'>
      </head>
      <body class='text-center'>
        <p>
          Ya existe el usuario
        </p>
        <a href='../index.html'>Volver</a>
      </body>
    </html>";
  }
  else
  {
    $query = "insert into usuario (nombre, contra) values ('".$_POST['usuario']."','".sha1( $_POST['password'])."')";
    mysqli_query($con, $query);
    mysqli_close($con);
    header("Location: ../index.html");
  }
  mysqli_close($con);
?>
