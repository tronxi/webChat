<?php
  session_start();
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST");
  header("Access-Control-Allow-Headers: *");
  header("Content-Type: application/json; charset=utf-8");
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
                      'texto' => encrypt_decrypt('decrypt', $fila['texto']));
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

    function encrypt_decrypt($action, $string)
	{
		$output = false;

		$encrypt_method = "AES-256-CBC";

		$key = hash('sha256', $secret_key);

		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		if( $action == 'encrypt' )
		{
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' )
		{
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}

		return $output;
	}
?>
