<?php
  session_start();
  header('Content-Type: text/html; charset=utf-8');
  include 'datos.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

	$algorithm = MCRYPT_BLOWFISH;
	$key = 'hola';
	$mode = MCRYPT_MODE_CBC;
	$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);

  $query = "select nombre, texto, fecha from mensaje where id_conversacion = ".$_SESSION['conversacion']."";
  $resul = mysqli_query($con, $query);
  $objJson = array();
  while($fila = mysqli_fetch_array($resul))
  {
    $objJson[] = array('nombre' => $fila['nombre'],
                        'fecha' => $fila['fecha'],
                      'texto' => mcrypt_decrypt($algorithm, $key, $fila['texto'], $mode, $iv););
  }

  $query = "UPDATE conversacion
			SET
				estado = 0
			WHERE
				id_conversacion = ".$_SESSION['conversacion']."
					AND nombre = (SELECT
						nombre
					WHERE
						id_conversacion = ".$_SESSION['conversacion']."
							AND nombre != '".$_SESSION['usuario']."');";
  mysqli_query($con, $query);
  mysqli_close($con);

  echo json_encode($objJson);
?>
