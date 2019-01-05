<?php
	session_start();
	include 'datos.php';
	$con = mysqli_connect($host, $usuario, $contraseña); mysqli_select_db($con, $bd);

	//$mensajeCifrado = encrypt( $_POST['mensaje']);
	$mensajeCifrado = encrypt_decrypt('encrypt', $_POST['mensaje']);

	$query = "insert into mensaje (nombre, texto, fecha, id_conversacion) values ('".$_SESSION['usuario']."', '".$mensajeCifrado."', '".date('Y/m/d H:i:s')."', ".$_SESSION['conversacion'].")";
	mysqli_query($con, $query);

	$query = "UPDATE conversacion
			SET
				estado = estado + 1
			WHERE
				id_conversacion = ".$_SESSION['conversacion']."
					AND nombre = '".$_SESSION['usuario']."'";
	$resul = mysqli_query($con, $query);
	$query = "SELECT u.nombre as nombre, u.token as token from usuario u, conversacion c where u.nombre = c.nombre and c.id_conversacion = ".$_SESSION['conversacion']." and u.nombre != '".$_SESSION['usuario']."';";
	$resul = mysqli_query($con, $query);
	$tokenNecesario = "";
	while($fila = mysqli_fetch_array($resul))
  	{
		$tokenNecesario = $fila['token'];
	}

	enviar($tokenNecesario);
	mysqli_close($con);

	function encrypt($mensaje)
	{
		$cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
		$key256 = '12345678901234561234567890123456';
		$iv = '1234567890123456';
		$plainText = $mensaje;
		mcrypt_generic_init($cipher, $key256, $iv);
		$cipherText256 = mcrypt_generic($cipher,$plainText );
		mcrypt_generic_deinit($cipher);
		$cipherHexText256 =bin2hex($cipherText256);
		echo $cipherHexText256;
	}

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
	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	  }

	function enviar($tokenNecs)
	{
		define('API_ACCESS_KEY','AAAA4iUUfRc:APA91bFSDG8l61UvTH3y3keSmNfTodFgaH9rNj2IE84z3Ob9YDtZqLkuGFNEv0G3kZnsj_8XYo5I0CCtQ9ZR9ZX1YIgtu01o7ePDcyU8lQuD6W6X-enuPL85zJsFnDTWXB5O61irybXO');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		$token= $tokenNecs;
	
			$notification = [
				'title' =>$_SESSION['usuario'],
				'body' =>  $_POST['mensaje']
			];
			$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
	
			$fcmNotification = [
				//'registration_ids' => $tokenList, //multple token array
				'to'        => $token, //single token
				'notification' => $notification,
				'data' => $extraNotificationData
			];
	
			$headers = [
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			];
	
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
			$result = curl_exec($ch);
			curl_close($ch);
	
	
			echo $result;
	}
?>
