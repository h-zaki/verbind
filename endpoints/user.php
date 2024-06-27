<?php

include dirname(__DIR__)."/config/database.php";
include dirname(__DIR__).'/functions/fetch.php';

if(isset($_GET['id']))
{
    $userid = $_GET['id'];
    $user = fetch($conn,"SELECT firstname,lastname,image from user where id = $userid");
    echo json_encode($user);
}
elseif($_SERVER['REQUEST_METHOD'] ===  'POST')
{
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    if (is_array($data)) {
        session_start();
        $_SESSION['conversation'] = $data['id'];
        $response = ['message' => "conv set to ".$_SESSION['conversation']];
    }
    else {
        $response = ['message' => "an error occured"];
    }
    echo json_encode($response);
}
else{
    http_response_code(400);
    echo 'bad request';
}