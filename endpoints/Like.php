<?php

include dirname(__DIR__)."/config/database.php";
include dirname(__DIR__).'/functions/fetch.php';


$jsonData = file_get_contents('php://input');


if (!empty($jsonData)) {
    $data = json_decode($jsonData, true);
    if (is_array($data)) {
        $postid = $data['postid'];
        $userid = $data['userid'];
         // Return a response (e.g., as JSON)
        save($conn,"INSERT into liked(userid,postid) VALUES ($userid,$postid)");
        $nbr = fetch($conn,"SELECT count(*) nbr from liked where postid = $postid")[0]["nbr"];
        $response = ['count' => $nbr];
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