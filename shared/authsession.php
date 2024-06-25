<?php

session_start();

if(isset($_SESSION['user']))
    $userid = $_SESSION['user'];
else
    header('Location: index.php');