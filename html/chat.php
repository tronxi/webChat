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
        <form metod="POST" action="../php/enviarMensaje.php">
        <div class="input-group mb-3">
          <input type="text" class="form-control">
          <div class="input-group-append">
            <button type="button" class="btn btn-lg btn-primary">
              Enviar
            </button>
          </div>
        </div>
    </form>
    </nav>
  </body>
</html>
