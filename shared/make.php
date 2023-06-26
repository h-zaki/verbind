<?php

include "config/cloudinary.php";
use Cloudinary\Api\Upload\UploadApi;

$upload = new UploadApi();


if(isset($_POST['PostShare']) && $_POST['PostText']){
    $postText =  mysqli_real_escape_string($conn,$_POST['PostText']);
    $postImage =  $_FILES["PostImage"]["tmp_name"];
    $image = null;
    if ($postImage){
        $uploaded = $upload->upload($postImage, [
            'overwrite' => true,
            'folder'  => 'verbind',
        ]);
        $image = $uploaded["public_id"];
    }
    // $upload->destroy($image);
   save($conn,"INSERT into post(userid,text,image) VALUES ($userid,'$postText','$image')");
    header("Location: profile.php");
}
?>

<form class="make" method="post" onsubmit="submitPost(event)" enctype="multipart/form-data">
      <div id="textarea" contenteditable placeholder="write something..." spellcheck="false"></div>
      <input type="hidden" id="hiddenTextarea" name="PostText" />
      <img src="" alt="" id="ImageHolder" style="width: 100%;">
      <div class="inter">
        <div><i class="fa-solid fa-camera"></i> <input type="file" name="PostImage" class ="custom-file-input"></div>
        <div><i class="fa-solid fa-share"></i> <input type="submit" value="Share" name="PostShare"> </div>
       </div>
</form>



<script src ="front-end/posthandling.js" defer></script>