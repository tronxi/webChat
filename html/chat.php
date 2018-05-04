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
    <link href="../css/chat.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <h1>chat</h1>
    <?php
      echo "<p>registrado como ". $_SESSION['usuario']. "</p>";
    ?>
    <button type="button" class="btn btn-lg btn-primary" onclick="window.location.href = '../php/cerrarSesion.php'">
      Cerrar Sesion
    </button>
    <div class="row">

        <div class="conversation-wrap col-lg-3">
            <div class="media conversation">
                <div class="media-body">
                    <h5 class="media-heading">Naimish Sakhpara</h5>
                    <small>Hello</small>
                </div>
            </div>

        </div>
  </body>
</html>
