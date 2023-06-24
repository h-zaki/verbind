<?php

function fetch ($conn,$query){

    $result = mysqli_query($conn,$query);
    $fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $fetched;
}

function save ($conn,$query){

    $result = mysqli_query($conn,$query);
    return $result;
}

?>