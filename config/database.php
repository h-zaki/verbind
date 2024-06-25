<?php

//databese connection
$conn = mysqli_connect('localhost','verbind','verbind','verbind');
if(!$conn)
    echo "Connextion error" . mysqli_connect_error();

?>