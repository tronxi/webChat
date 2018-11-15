<?php
    
    $message = "hola"; // El mensaje que vayas a enviar
    $title = "titulo"; // Título de la notificación
    $path_to_fcm = "https://fcm.googleapis.com/fcm/send";
    $server_key="AAAA4iUUfRc:APA91bFSDG8l61UvTH3y3keSmNfTodFgaH9rNj2IE84z3Ob9YDtZqLkuGFNEv0G3kZnsj_8XYo5I0CCtQ9ZR9ZX1YIgtu01o7ePDcyU8lQuD6W6X-enuPL85zJsFnDTWXB5O61irybXO";
    //$sql = “Tu query donde buscas el Token del usuario que te interesa”;
    //$result = mysqli_query($con, $sql); // Conexión con la Base de Datos
    //$row = mysqli_fetch_row($result); 
    $keyToken = "fM_EIbnlLkI:APA91bFDYErasu18pKFh6JXZCJ8m9uW5vEyjuJf-Geen02AWpKIlyzIaM55GbolC6IWCjuRJDj7NSwMYt_w9KqtJ48hIXkpCSu72FdMDWEGDvSRUKJXd8gCYh8lOEhcsa9mg8Gbo69Wg"; // Obtención del Token
    $headers = array( 
    'Authorization:key=' .$server_key,
    'Content-Type:application/json',
    'Content-Length: 0’'
    );
    // Para un solo token, si es para varios usar “registration_ids” en vez de “to”.
    $fields = array('to'=>$keyToken, 'notification'=>array('title'=>$title, 'body'=>$message));
    $payload = json_encode($fields);
    // Abrir la sesión
    echo "hola";
    $curl_session = curl_init();
    // Definir la URL a la que se le hará el post
    curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
    // Indicar el tipo de petición: POST
    curl_setopt($curl_session, CURLOPT_POST, TRUE);
    curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
    // Recibimos una respuesta y la guardamos en una variable
    curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
    $remote_server_output = curl_exec($curl_session);
    curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURLOPT_IPRESOLVE_v4);
    // Definir cada uno de los parámetros
    curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
    //$result = curl_exeec($curl_session);
    #mysqli_close($con);
    // Cerrar la sesion
    curl_close($curl_session);
    // Mostrar el resultado
    print_r($remote_server_output);
?>