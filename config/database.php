<?php

//databese connection
$conn = mysqli_connect('localhost','verbind','password','verbinf');
if(!$conn)
    echo "Connextion error" . mysqli_connect_error();

?>