<?php
  session_start();
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<title>WebChat</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
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
