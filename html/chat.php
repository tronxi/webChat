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
    <h1>
      chat
      <button type="button" class="btn btn-lg btn-primary" onclick="window.location.href = '../php/cerrarSesion.php'">
        Cerrar Sesion
      </button>
    </h1>
    <?php
      echo "<p>registrado como ". $_SESSION['usuario']. "</p>";
    ?>
    <textarea rows="100" cols="100" class="pre-scrollable form-control"id="aboutDescription" style="resize: none;">
    </textarea>
<nav class="navbar navbar-inverse navbar-fixed-buttom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Sitio Web</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Inicio</a></li>
      <li><a href="#">P&aacute;gina 1</a></li>
      <li><a href="#">P&aacute;gina 2</a></li>
      <li><a href="#">P&aacute;gina 3</a></li>
    </ul>
  </div>
</nav>
  </body>
</html>
