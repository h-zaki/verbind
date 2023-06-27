<?php

include dirname(__DIR__)."/config/database.php";
include dirname(__DIR__).'/functions/fetch.php';





$jsonData = file_get_contents('php://input');


if (!empty($jsonData)) {
    $data = json_decode($jsonData, true);
    if (is_array($data)) {
        $postid = $data['postid'];
        $text = $data['text'];
        $userid = $data['userid'];
        save($conn,"INSERT into comment(userid,postid,text) VALUES ($userid,$postid,'$text')");
        $nbr = fetch($conn,"SELECT count(*) nbr from comment where postid = $postid")[0]["nbr"];
        $user = fetch($conn,"SELECT CONCAT(firstname, ' ', lastname) user from user where id = $userid")[0]["user"];
        // $response = ['count' => $nbr];
        echo json_encode(["count"=>$nbr,"user"=>$user]);
    }
  else {
    // JSON decoding failed
    http_response_code(400);
    echo 'Invalid JSON data';
} 
}
else {

    if(isset($_GET['id']))
    {
    $postid = $_GET['id'];
    $comments = fetch($conn,"SELECT c.text,CONCAT(u.firstname, ' ', u.lastname) user from comment c join user u on u.id=c.userid where postid = $postid");
    echo json_encode($comments);
    }
    else{
    // No data received
    http_response_code(400);
    echo 'No data received';
    }
}