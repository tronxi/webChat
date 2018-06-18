<?php
  session_start();
  header('Content-Type: text/html; charset=utf-8');
  include 'datos.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

  $query = "select nombre, texto, fecha from mensaje where id_conversacion = ".$_SESSION['conversacion']."";
  $resul = mysqli_query($con, $query);
  $objJson = array();
  while($fila = mysqli_fetch_array($resul))
  {
    $objJson[] = array('nombre' => $fila['nombre'],
                        'fecha' => $fila['fecha'],
                      'texto' => $fila['texto']);
  }

  $query = "UPDATE conversacion
			SET
				estado = 0
			WHERE
				id_conversacion = ".$_SESSION['conversacion']."
					AND nombre = '".$_SESSION['usuario']."';";
  mysqli_close($con);

  echo json_encode($objJson);
?>
