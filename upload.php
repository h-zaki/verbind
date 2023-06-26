<?php

include "config/cloudinary.php";
use Cloudinary\Api\Upload\UploadApi;

$upload = new UploadApi();

$uploaded = $upload->upload('images/Account.png', [
    'public_id' => 'pieceofgarbage',
    'use_filename' => true,
    'overwrite' => true,
    'folder'  => 'verbind',
]);

?>