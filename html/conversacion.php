<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>WebChat</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="../javascprit/conversacion.js"></script>
	<link href="../css/conversacion.css" rel="stylesheet">
</head>

<body class="text-center">
	<h1>
		<button type="button" class="btn btn-lg btn-primary" onclick="window.location.href = 'buscarPersonas.html'">Buscar
		</button> chat
		<button type="button" class="btn btn-lg btn-primary" onclick="window.location.href = '../php/cerrarSesion.php'">
        Cerrar Sesion
      </button>
	</h1>
	<?php
	  session_start();
      echo "<p>registrado como ". $_SESSION['usuario']. "</p>";
    ?>
		<div class="container text-center">
			<div class='row grid-groud-item' id="conversaciones">

			</div>
		</div>
</body>

</html>
