<?php
	session_start();
	include 'datos.php';
	const METHOD = 'aes-256-ctr';

	$con = mysqli_connect($host, $usuario, $contraseña); mysqli_select_db($con, $bd);

	$mensajeCifrado = encrypt( $_POST['mensaje'], 'd6F3Efeq');
	//$mensajeCifrado = encrypt_decrypt('encrypt', $_POST['mensaje']);

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

	public function encrypt($plaintext, $password, $salt='', $encode = false)
   {
      $keyAndIV = self::evpKDF($password, $salt);

      $ciphertext = openssl_encrypt(
                                       $plaintext,
                                       self::METHOD,
                                       $keyAndIV["key"],
                                       OPENSSL_RAW_DATA,
                                       $keyAndIV["iv"]
                                    );

      $ciphertext = bin2hex($ciphertext);

      if ($encode)
      {
         $ciphertext = base64_encode($ciphertext);
      }

      return $ciphertext;
   }

	public function evpKDF($password, $salt, $keySize = 8, $ivSize = 4, $iterations = 1, $hashAlgorithm = "md5")
   {
      $targetKeySize = $keySize + $ivSize;
      $derivedBytes  = "";

      $numberOfDerivedWords = 0;
      $block         = NULL;
      $hasher        = hash_init($hashAlgorithm);

      while ($numberOfDerivedWords < $targetKeySize)
      {
         if ($block != NULL)
         {
            hash_update($hasher, $block);
         }

         hash_update($hasher, $password);
         hash_update($hasher, $salt);

         $block   = hash_final($hasher, TRUE);
         $hasher  = hash_init($hashAlgorithm);

         // Iterations
         for ($i = 1; $i < $iterations; $i++)
         {
            hash_update($hasher, $block);
            $block   = hash_final($hasher, TRUE);
            $hasher  = hash_init($hashAlgorithm);
         }

         $derivedBytes .= substr($block, 0, min(strlen($block), ($targetKeySize - $numberOfDerivedWords) * 4));

         $numberOfDerivedWords += strlen($block)/4;
      }

      return array(
                     "key" => substr($derivedBytes, 0, $keySize * 4),
                     "iv"  => substr($derivedBytes, $keySize * 4, $ivSize * 4)
                   );
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
