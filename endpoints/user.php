<?php

include dirname(__DIR__)."/config/database.php";
include dirname(__DIR__).'/functions/fetch.php';




if(isset($_GET['id']))
{
    $userid = $_GET['id'];
    $user = fetch($conn,"SELECT firstname,lastname,image from user where id = $userid");
    echo json_encode($user);
}
else{
    http_response_code(400);
    echo 'No id received';
}