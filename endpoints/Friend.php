<?php

include dirname(__DIR__)."/config/database.php";
include dirname(__DIR__).'/functions/fetch.php';


$jsonData = file_get_contents('php://input');


if (!empty($jsonData)) {
    $data = json_decode($jsonData, true);
    if (is_array($data)) {
        $f1 = $data['f1'];
        $f2 = $data['f2'];
         // Return a response (e.g., as JSON)
        if( $_SERVER['REQUEST_METHOD'] ===  'POST'){
            save($conn,"INSERT into friend(f1,f2) VALUES ($f1,$f2)");
            $response = ['message' => "request sent"];
        } else if ( $_SERVER['REQUEST_METHOD'] ===  'DELETE'){
            save($conn,"DELETE from friend where (f1 = $f1 and f2 = $f2) or (f2 = $f1 and f1 = $f2)");
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