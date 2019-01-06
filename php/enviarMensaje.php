<?php
	session_start();
	include 'datos.php';
	$con = mysqli_connect($host, $usuario, $contraseña); mysqli_select_db($con, $bd);
	$mensajeCifrado = $_POST['mensaje'];
	$query = "insert into mensaje (nombre, texto, fecha, id_conversacion) values ('".$_SESSION['usuario']."', AES_ENCRYPT('".$mensajeCifrado."', '".$secret_key."'),'".date('Y/m/d H:i:s')."', ".$_SESSION['conversacion'].")";
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


	function enviar($tokenNecs)
	{
		define('API_ACCESS_KEY',$server_key);
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
