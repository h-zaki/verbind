<?php

function friends($conn, $id){
    return fetch($conn,"SELECT * from user u join friend f on u.id = f.f1 where f2 = $id union SELECT * from user u join friend f on u.id = f.f2 where f1 = $id");
}

?>