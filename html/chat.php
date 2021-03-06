<?php
  session_start();
?>
	<!DOCTYPE html>
	<html>
  
	<head>
		<meta charset="utf-8">
		<title>WebChat</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="../javascprit/enviarMensaje.js"></script>
		<script src="../javascprit/mostrarMensaje.js"></script>
		<link href="../css/chat.css" rel="stylesheet">
	</head>

	<body class="text-center">
		<h1>
			<button type="button" class="btn btn-lg btn-primary" onclick="window.location.href = 'conversacion.php'">
        		atras
      		</button> chat
			<button type="button" class="btn btn-lg btn-primary" onclick="window.location.href = '../php/cerrarSesion.php'">
        Cerrar Sesion
      </button>
		</h1>
		<?php
      echo "<p>registrado como ". $_SESSION['usuario']. "</p>";
    ?>
			<textarea rows="100" cols="100" class="pre-scrollable form-control" id="conversacion" style="resize: none;" disabled>
    </textarea>
			<nav class="navbar navbar-inverse navbar-fixed-buttom text">
				<p class="text-center">
					<form metod="POST" action="../php/enviarMensaje.php" id="enviarF">
						<div class="input-group">
							<input type="text" class="form-control" id="mensaje" name="mensaje" autocomplete="off">
							<div class="input-group-append">
								<button type="submit" class="btn btn-lg btn-primary" id="enviar">
              Enviar
            </button>
							</div>
						</div>
					</form>
				</p>
			</nav>
	</body>

	</html>
