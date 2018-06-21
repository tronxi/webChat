<?php
	session_start();
	include 'datos.php';
	$con = mysqli_connect($host, $usuario, $contraseña); mysqli_select_db($con, $bd);

	$mensajeCifrado = encrypt_decrypt('encrypt', $_POST['mensaje']);

	$query = "insert into mensaje (nombre, texto, fecha, id_conversacion) values ('".$_POST['usuario']."', '".$mensajeCifrado."', '".date('Y/m/d H:i:s')."', ".$_POST['conversacion'].")";
	mysqli_query($con, $query);

	$query = "UPDATE conversacion
			SET
				estado = estado + 1
			WHERE
				id_conversacion = ".$_POST['conversacion']."
					AND nombre = '".$_POST['usuario']."'";
	mysqli_query($con, $query);
	mysqli_close($con);

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
