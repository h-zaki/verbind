<?php 
    $currentPage = 'home';
    include 'config/database.php';
    include 'functions/fetch.php';
    include 'shared/authsession.php';

    

    $posts = fetch($conn,"SELECT * from (SELECT p.id,p.userid,p.text,p.image,p.time, u.firstname,u.lastname,u.image pimage,'' repost  from post p JOIN user u on u.id = p.userid 
                            union SELECT p.id,r.userid,p.text,p.image,p.time, u.firstname,u.lastname,u.image pimage,CONCAT(x.firstname,' ',x.lastname) repost from repost r 
                                               JOIN post p on p.id = r.postid JOIN user u on u.id = r.userid JOIN user x on x.id = p.userid ) posts
                            where userid in 
                          (SELECT userid from user u join friend f on userid = f.f1 where f2 = $userid union SELECT userid from user u join friend f on userid = f.f2 where f1 = $userid)
                           ORDER BY time desc");
?>


<!DOCTYPE html>
<html lang="en" spellcheck="false">
<?php  
require "shared/header.php"; 
?>
<section id="content">

<?php include 'shared/nav.php'?>

<div id ="feed">

    <?php include 'shared/make.php';?>

    <?php foreach ($posts as $post) : 
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
                        <img src="<?php if($post['pimage']) echo  $post['pimage'];
                            else    echo"images/Account.webp"; ?>" alt="">
                        <span><?php echo htmlspecialchars($post['firstname'])." ".htmlspecialchars($post['lastname']);  
                            if($post['repost']) echo " repost from " .$post['repost'];          ?> </span>
                    </a>
                    <button id="post-info" >
                        <i class="fa-solid fa-ellipsis-h"></i></button>
                    <div class = "post-opt">
                        <button onclick="handleremovefriend(null,<?php echo $userid?>,<?php echo $post['userid']?>)" data-shown = false> 
                            unfriend <?php echo htmlspecialchars($post['firstname'])." ".htmlspecialchars($post['lastname']) ?> </button>
                    </div>
                </div>
          
                <div class = "f-text">
                <?php echo $post["text"] ?>
                </div>
                <img src="<?php if($post["image"]) echo "https://res.cloudinary.com/dg1vm1zpr/image/upload/v1687615647/".htmlspecialchars($post["image"]) ?>" alt="">
                <div class="inter">
                    <button  <?php if($liked) echo 'data-done'; ?> onclick="interact(handlelike,[event, <?php echo $id?>,<?php echo $userid?>,<?php echo $post['userid']?>])">
                                <i class="<?php if($liked) echo 'fas'; else echo 'far'?> fa-heart"></i> <span> <?php echo htmlspecialchars($likes) ?> Likes </span></button> 
                    <button onclick = "handleshowcomments(event, <?php echo $id?>,<?php echo $userid?>,<?php echo $post['userid']?>)"><i class="far fa-comment"></i> <span>
                                <?php echo htmlspecialchars($comments) ?>  Comments </span></button>
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



<?php require "shared/footer.php"?>
<script> const myName = "<?php echo $thisuser['firstname']?>",myImage = "<?php echo $thisuser['image']?>"; </script>
<script src = "front-end/interactionHandler.js" defer></script>




</html>

