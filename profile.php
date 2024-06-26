<?php 
    $currentPage = 'profile';
    include 'functions/fetch.php';
    include_once 'functions/friends.php';
    include 'config/database.php';
    include 'shared/authsession.php';



    //change image

    include "config/cloudinary.php";
    use Cloudinary\Api\Upload\UploadApi;

    $upload = new UploadApi();


    if(isset($_POST['profile-pic'])){
        $receivedImage =  $_FILES["ProfileImage"]["tmp_name"];
        
        $image = null;
        if ($receivedImage){
            $uploaded = $upload->upload($receivedImage, [
                'overwrite' => true,
                'folder'  => 'verbind/profile',
            ]);
            $image = "https://res.cloudinary.com/dg1vm1zpr/image/upload/v1687615647/".$uploaded["public_id"];
        }
    // $upload->destroy($image);
    save($conn,"UPDATE user SET image = '$image' WHERE id = $userid; ");
}




    
    
    $personId = $userid;
    if(isset($_GET['id']))
        $personId = $_GET['id'];
    
    $me = ($personId == $userid);
    $user = fetch($conn,"SELECT * from user where id = $personId")[0];
    $friends = friends($conn,$personId);
    if(isset($_GET['post']))
        $posts = fetch($conn,"SELECT p.id, p.userid, p.text, p.image, p.time, '' AS repost FROM post p where id = " .$_GET['post']);
    else
        $posts = fetch($conn,"SELECT * from ((SELECT p.id, r.userid, p.text, p.image, p.time, CONCAT(x.firstname, ' ', x.lastname) AS repost FROM repost r JOIN post p ON r.postid = p.id JOIN user x ON x.id = p.userid) UNION 
                        (SELECT p.id, p.userid, p.text, p.image, p.time, '' AS repost FROM post p)) posts where userid = $personId  ORDER by time desc");
    
    //$status
    $status = "";
    if(!$me){
        $isfriend = fetch($conn,"SELECT * from friend where (f1 = $userid and f2 = $personId) or (f2 = $userid and f1 = $personId)"); 
        if($isfriend)
           $status = "friend";
        else
        {
           $requested = fetch($conn,"SELECT * from friend_request where (sender = $userid and receiver = $personId) or (receiver = $userid and sender = $personId)"); 
           $status = count($requested) ? ($requested[0]["sender"] == $userid ? "sent" : "received") : "";
        }
    }
?>


<!DOCTYPE html>
<html lang="en" spellcheck="false">
<?php  
require "shared/header.php"; 
?>

<section id="content">
<?php 
require "shared/nav.php";
?>



<div id ="feed">
    
    <div class="profile">
       <div class="picture"> 
            <?php if($me): ?>
                <form class="p-changer" method="post" enctype="multipart/form-data">
                    <input id="profileP"  type="file" accept="image/*" name="ProfileImage" class ="picture-input">
                    <label for="profileP" class="custom-file-input-label" ><i class="fa-solid fa-camera"></i></label>
                    <input id="change-image" type="submit" style="display: none;" name="profile-pic">
                    <label for="change-image" class="change-image-label" style="display: none;"><i class="fa-solid fa-check" ></i></label>
                </form>
            <?php    endif ?>  

            <?php if($user['image']): ?>
                    <div class= "pic-container"><img src="<?php echo $user['image']?>" alt=""></div>
            <?php    else: ?>   
                        <div class= "pic-container">
                            <img src="images/Account.webp" alt=""> 
                        </div>
            <?php    endif ?>    

            <span><?php echo htmlspecialchars($user['firstname'])." ".htmlspecialchars($user["lastname"]) ?></span>
        </div> 

            <a href="friends.php?id=<?php echo $personId ?>"><?php echo count($friends)?> <br> friends</a>
            <span><?php echo count($posts)?> <br> posts</span>
    </div>
    <?php
    if ($me)
        include "shared/make.php";
    else {
        echo '<div class="inter make">';
        switch ($status)
        {
            case"friend":
                ?> <button data-done onclick= "handleremovefriend(event ,<?php echo $userid ?>,<?php echo $personId ?>)"><i class="fa-solid fa-user-minus"></i> Remove friend</button>
                <?php
                break;
            case"sent":
                ?> <button data-done onclick= "handleremoverequest(event ,<?php echo $userid ?>,<?php echo $personId ?>)"><i class="fa-solid fa-user-minus"></i> Remove request</button>
                <?php
                break;
            case"received":
                ?> 
                <button onclick= "handleacceptfriend(event ,<?php echo $personId ?>,<?php echo $userid ?>); event.currentTarget.parentElement.removeChild(event.currentTarget.nextElementSibling)"><i class="fa-solid fa-user-check"></i> Accept request</button>
                 <button onclick= "handleremoverequest(event ,<?php echo $personId ?>,<?php echo $userid ?>); event.currentTarget.parentElement.removeChild(event.currentTarget.previousElementSibling)"><i class="fa-solid fa-user-xmark"></i> Refuse request</button>
                 <?php
                break;
            default:    
                ?> 
                <button onclick= "handlerequestfriend(event ,<?php echo $userid ?>,<?php echo $personId ?> ,(element,sender,receiver)=>{interact(profileFriendRequested,[element,sender,receiver] )})"><i class="fa-solid fa-user-plus"></i> Add friend</button>
                <?php    
        }
        echo    '<button class ="dm-opener" ><i class="fa-solid fa-message"></i> Send message</button class ="dm-opener" >
             </div>';
    }
    ?>
   <?php  if(!count($posts))
            echo "<span class='profile-announce'> no posts found <span>"; 
     foreach ($posts as $post) : 
        $id = $post["id"];
        $likes = fetch($conn,"SELECT count(*) nbr from liked where postid = $id")[0]["nbr"];
        $liked = fetch($conn,"SELECT userid from liked where postid = $id and userid = $userid");
        $comments = fetch($conn,"SELECT count(*) nbr from comment where postid = $id")[0]["nbr"];
        $shares = fetch($conn,"SELECT count(*) nbr from repost where postid = $id")[0]["nbr"];
        $shared = fetch($conn,"SELECT userid from repost where postid = $id and userid = $userid");
        ?>
        <div class="f-element" id="post-<?php echo $post["id"]?>">
        <div class="f-header">
                  <a  href = "profile.php?id=<?php echo $post['userid']?>">  
                  <?php if($user['image']): ?>
                    <img src="<?php echo $user['image']?>" alt="">
                  <?php    else: ?>   
                    <img src="images/Account.webp" alt="">
                  <?php    endif ?> 
                    <span><?php echo htmlspecialchars($user['firstname'])." ".htmlspecialchars($user['lastname']);  
                           if($post['repost']) echo " repost from " .$post['repost'];          ?> </span>
                    </a>
                    <?php if($me): ?>
                        <button id="post-info" >
                            <i class="fa-solid fa-ellipsis-h"></i></button>
                        <div class = "post-opt">
                            <button onclick="handledeletepost(<?php echo $post['id'] ?>)" data-shown = false> 
                                delete post </button>
                        </div>
                    <?php endif; ?>
                </div>
          
                <div class = "f-text">
                <?php echo $post["text"]?>
                </div>
                <img src="<?php if($post["image"]) echo "https://res.cloudinary.com/dg1vm1zpr/image/upload/v1687615647/".htmlspecialchars($post["image"]) ?>" alt="">
                <div class="inter">
                    <button  <?php if($liked) echo 'data-done'; ?> onclick="interact(handlelike,[event, <?php echo $id?>,<?php echo $userid?>,<?php echo $post['userid']?>])">
                                <i class="<?php if($liked) echo 'fas'; else echo 'far'?> fa-heart"></i> <span> <?php echo htmlspecialchars($likes) ?> Likes </span></button> 
                    <button onclick = "handleshowcomments(event, <?php echo $id?>,<?php echo $userid?>,<?php echo $post['userid']?>)"><i class="far fa-comment"></i> 
                               <span> <?php echo htmlspecialchars($comments) ?> Comments </span> </button>
                    <button <?php if($shared) echo 'data-done'; ?> onclick = "interact(handleshare,[event, <?php echo $id?>,<?php echo $userid?>,<?php echo $post['userid']?>])"><i class="fas fa-share"></i> 
                                <span><?php echo htmlspecialchars($shares) ?>  Shares</span></button>
                </div>
                <div class="comments">
                </div>
        </div>
    <?php  endforeach ?>
</div>

    <aside>
        <?php include "shared/people.php";?>
        <?php include "shared/dms.php";?>
    </aside>

    <?php
        include "shared/conversations.php"
    ?>
</section>
<?php require "shared/footer.php"  ?>
<script> const myName = "<?php echo $thisuser['firstname']?>",myImage = "<?php echo $thisuser['image']?>"; </script>
<script src = "front-end/interactionHandler.js" defer></script>
<script src = "front-end/friendHandler.js" defer></script>
</html>


<script defer type="module">
    import {loadConversation} from "./front-end/messaging.js"

    const button = document.querySelector(".dm-opener")

    button?.addEventListener('click', (event) => {
        loadConversation({firstname:"<?php echo $user['firstname']?>",lastname:"<?php echo $user['lastname']?>",
            image:"<?php echo $user['image']?>"},<?php echo $personId?>)
    });

</script>


<script>
    document.querySelector(".picture-input").addEventListener('change',(event)=>{
            const file = event.target.files[0];
            event.target.parentNode.lastElementChild.style.display = "inline"
            if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.querySelector(".picture .pic-container img").setAttribute("src",event.target.result)
            };
                reader.readAsDataURL(file);
            }
    })
</script>