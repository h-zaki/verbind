<?php

include dirname(__DIR__)."/config/database.php";
include dirname(__DIR__).'/functions/fetch.php';

session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $_SESSION["user"];
    if ( $_SERVER['REQUEST_METHOD'] ===  'DELETE'){
        save($conn,"DELETE from post where id = $id and userid = $user");
        $response = ['message' => "post deleted"];
        echo json_encode($response);
    }else{
        http_response_code(400);
        echo 'bad request';
    }
    
}
else {
    http_response_code(400);
    echo 'No id received';
}