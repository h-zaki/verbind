<?php 
    $currentPage = 'profile';
    include 'functions/fetch.php';
    include 'functions/friends.php';
    include 'config/database.php';


    $userid = 21;

    
    $personId = $userid;
    if(isset($_GET['id']))
        $personId = $_GET['id'];
    
    $me = ($personId == $userid);
    $user = fetch($conn,"SELECT * from user where id = $personId")[0];
    $friends = friends($conn,$personId);
    $posts = fetch($conn,"SELECT * from (SELECT *,'' repost from post  
                        union SELECT p.id,r.userid,p.text,p.image,p.time,CONCAT(x.firstname,' ',x.lastname) repost from  repost r join post p on r.postid = p.id join user x on x.id = p.userid) posts where userid = $personId  ORDER by time desc");
    
    //$status
    $status = "";
    if(!$me){
        $isfriend = fetch($conn,"SELECT * from friend where (f1 = $userid and f2 = $personId) or (f2 = $userid and f1 = $personId)"); 
        if($isfriend)
           $status = "friend";
        else
        {
           $requested = fetch($conn,"SELECT * from friend_request where (sender = $userid and receiver = $personId) or (receiver = $userid and sender = $personId)"); 
           
           $status = $requested ? ($requested["sender"][0] == $userid ? "sent" : "received") : "";
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
require "shared/nav.php"
?>



<div id ="feed">
    
    <div class="profile">
       <div class="picture"> 
            <?php if($user['image']): ?>
                    <img src="<?php echo $user['image']?>" alt="">
            <?php    else: ?>   
                    <img src="images/Account.webp" alt="">
            <?php    endif ?> 
            <span><?php echo htmlspecialchars($user['firstname'])." ".htmlspecialchars($user["lastname"]) ?></span>
        </div> 

            <a href="friends.php"><?php echo count($friends)?> <br> friends</a>
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
                echo '<button data-done><i class="fa-solid fa-user-minus"></i> Remove friend</button>';
                break;
            case"sent":
                echo '<button data-done><i class="fa-solid fa-user-minus"></i> Remove request</button>';
                break;
            case"received":
                echo '<button><i class="fa-solid fa-user-check"></i> Accept request</button>';
                break;
            default:    
                echo '<button><i class="fa-solid fa-user-plus"></i> Add friend</button>';
        }
        echo    '<div><i class="fa-solid fa-message"></i> Send message</div>
             </div>';
    }
    ?>
   <?php  if(!count($posts))
            echo "<span class='profile-announce'> this user has no posts <span>"; 
     foreach ($posts as $post) : 
        $id = $post["id"];
        $likes = fetch($conn,"SELECT count(*) nbr from liked where postid = $id")[0]["nbr"];
        $liked = fetch($conn,"SELECT userid from liked where postid = $id and userid = $userid");
        $comments = fetch($conn,"SELECT count(*) nbr from comment where postid = $id")[0]["nbr"];
        $shares = fetch($conn,"SELECT count(*) nbr from repost where postid = $id")[0]["nbr"];
        $shared = fetch($conn,"SELECT userid from repost where postid = $id and userid = $userid");
        ?>
        <div class="f-element">
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
                    <button><i class="fa-solid fa-ellipsis-h"></i></button>
                </div>
          
                <div class = "f-text">
                <?php echo htmlspecialchars($post["text"]) ?>
                </div>
                <img src="<?php if($post["image"]) echo "https://res.cloudinary.com/dg1vm1zpr/image/upload/v1687615647/".htmlspecialchars($post["image"]) ?>" alt="">
                <div class="inter">
                    <button  <?php if($liked) echo 'data-done'; ?> onclick="handlelike(event, <?php echo $id?>,<?php echo $userid?>)">
                                <i class="<?php if($liked) echo 'fas'; else echo 'far'?> fa-heart"></i> <span> <?php echo htmlspecialchars($likes) ?> Likes </span></button> 
                    <button onclick = "handleshowcomments(event, <?php echo $id?>,<?php echo $userid?>)"><i class="far fa-comment"></i> 
                               <span> <?php echo htmlspecialchars($comments) ?> Comments </span> </button>
                    <button <?php if($shared) echo 'data-done'; ?> onclick = "handleshare(event, <?php echo $id?>,<?php echo $userid?>)"><i class="fas fa-share"></i> 
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
<script src = "front-end/interactionHandler.js" defer></script>
</html>



