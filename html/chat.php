<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WebChat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src=""></script>
  </head>
  <body class="text-center">
    <h1>chat</h1>
    <?php
      echo "registrado como ". $_SESSION['usuario'];
    ?>
    <button type="button" onclick="window.location.href = '../php/cerrarSesion.php'">
    </button>
  </body>
</html>
