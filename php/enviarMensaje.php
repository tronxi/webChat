<?php
	session_start();
	include 'datos.php';
	$con = mysqli_connect($host, $usuario, $contraseña); mysqli_select_db($con, $bd);
	$mensajeCifrado = $_POST['mensaje'];
	$query = "insert into mensaje (nombre, texto, fecha, id_conversacion) values ('".$_SESSION['usuario']."', AES_ENCRYOT('".$mensajeCifrado."', '".$key."'),'".date('Y/m/d H:i:s')."', ".$_SESSION['conversacion'].")";
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

	function encrypt($plaintext, $passphrase) {
		$salt = openssl_random_pseudo_bytes(16);
		$nonce = openssl_random_pseudo_bytes(12);
		$key = hash_pbkdf2("sha256", $passphrase, $salt, 40000, 32, true);
		$ciphertext = openssl_encrypt($plaintext, 'aes-256-gcm', $key, 1, $nonce, $tag);
		return base64_encode($salt.$nonce.$ciphertext.$tag);
	}

	function encrypt_decrypt($action, $string)
	{
		$output = false;

		$encrypt_method = "AES-256-CBC";

		//$key = hash('sha256', $secret_key);

		//$iv = substr(hash('sha256', $secret_iv), 0, 16);
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
