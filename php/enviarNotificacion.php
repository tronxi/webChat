<?php
    
    use sngrl\PhpFirebaseCloudMessaging\Client;
    use sngrl\PhpFirebaseCloudMessaging\Message;
    use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
    use sngrl\PhpFirebaseCloudMessaging\Notification;

    $server_key = 'AAAA4iUUfRc:APA91bFSDG8l61UvTH3y3keSmNfTodFgaH9rNj2IE84z3Ob9YDtZqLkuGFNEv0G3kZnsj_8XYo5I0CCtQ9ZR9ZX1YIgtu01o7ePDcyU8lQuD6W6X-enuPL85zJsFnDTWXB5O61irybXO';
    $client = new Client();
    $client->setApiKey($server_key);

    $message = new Message();
    $message->setPriority('high');
    $message->addRecipient(new Device('fM_EIbnlLkI:APA91bFDYErasu18pKFh6JXZCJ8m9uW5vEyjuJf-Geen02AWpKIlyzIaM55GbolC6IWCjuRJDj7NSwMYt_w9KqtJ48hIXkpCSu72FdMDWEGDvSRUKJXd8gCYh8lOEhcsa9mg8Gbo69Wg'));
    $message->setNotification(new Notification('php', 'soy una puta maquina'));

    $response = $client->send($message);
    var_dump($response->getStatusCode());
    var_dump($response->getBody()->getContents());
?>