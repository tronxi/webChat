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
                      'texto' => decrypt($fila['texto'], $key));
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

  function decrypt($ciphertext, $passphrase) {
    $input = base64_decode($ciphertext);
    $salt = substr($input, 0, 16);
    $nonce = substr($input, 16, 12);
    $ciphertext = substr($input, 28, -16);
    $tag = substr($input, -16);
    $key = hash_pbkdf2("sha256", $passphrase, $salt, 40000, 32, true);
    $plaintext = openssl_decrypt($ciphertext, 'aes-256-gcm', $key, 1, $nonce, $tag);
    return $plaintext;
}
    function encrypt_decrypt($action, $string)
	{
		$output = false;

		$encrypt_method = "AES-256-CBC";

		$key = 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
    	$iv = 'AAAAAAAAAAAAAAAA';

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
