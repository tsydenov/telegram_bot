<?php

***REMOVED***

// echo file_get_contents('https://api.telegram.org/bot***REMOVED***/getMe');
$data = json_decode(file_get_contents('php://input'), TRUE);

$response = [
    'chat_id' => $data['message']['chat']['id'],
    'text' => 'Hello!'
];

$ch = curl_init('https://api.telegram.org/bot' . TOKEN . '/sendMessage');
// $ch = curl_init('https://api.telegram.org/bot***REMOVED***/sendMessage');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_exec($ch);
curl_close($ch);
