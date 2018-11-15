<?php
    
    define('API_ACCESS_KEY','AAAA4iUUfRc:APA91bFSDG8l61UvTH3y3keSmNfTodFgaH9rNj2IE84z3Ob9YDtZqLkuGFNEv0G3kZnsj_8XYo5I0CCtQ9ZR9ZX1YIgtu01o7ePDcyU8lQuD6W6X-enuPL85zJsFnDTWXB5O61irybXO');
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    $token='fM_EIbnlLkI:APA91bFDYErasu18pKFh6JXZCJ8m9uW5vEyjuJf-Geen02AWpKIlyzIaM55GbolC6IWCjuRJDj7NSwMYt_w9KqtJ48hIXkpCSu72FdMDWEGDvSRUKJXd8gCYh8lOEhcsa9mg8Gbo69Wg';
   
        $notification = [
               'title' =>'title',
               'body' => 'body of message.'
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
?>