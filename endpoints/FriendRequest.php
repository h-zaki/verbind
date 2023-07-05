<?php

include dirname(__DIR__)."/config/database.php";
include dirname(__DIR__).'/functions/fetch.php';


$jsonData = file_get_contents('php://input');


if (!empty($jsonData)) {
    $data = json_decode($jsonData, true);
    if (is_array($data)) {
        $sender = $data['sender'];
        $receiver = $data['receiver'];
         // Return a response (e.g., as JSON)
        if( $_SERVER['REQUEST_METHOD'] ===  'POST'){
            save($conn,"INSERT into friend_request(sender,receiver) VALUES ($sender,$receiver)");
            $response = ['message' => "request sent"];
        } else if ( $_SERVER['REQUEST_METHOD'] ===  'DELETE'){
            save($conn,"DELETE from friend_request where sender = $sender and receiver = $receiver");
            $response = ['message' => "request deleted"];
        }
        echo json_encode($response);
    }
  else {
    // JSON decoding failed
    http_response_code(400);
    echo 'Invalid JSON data';
} 
}
else {
    // No data received
    http_response_code(400);
    echo 'No data received';
}