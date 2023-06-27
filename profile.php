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
                        union SELECT p.id,r.userid,p.text,p.image,p.time,CONCAT(x.firstname,' ',x.lastname) repost from  repost r join post p on r.postid = p.id join user x on x.id = p.userid) posts where userid = $userid  ORDER by time desc");

?>


<!DOCTYPE html>
<html lang="en" spellcheck="false">
<?php  
require "shared/header.php"; 
require "shared/nav.php"
?>

<section id="content">

<?php include 'shared/people.php' ?>


<div id ="feed">
    
    <div class="profile">
       <div class="picture"> 
            <?php if($user['image']): ?>
                    <img src="<?php echo $user['image']?>" alt="">
            <?php    else: ?>   
                    <img src="images/Account.png" alt="">
            <?php    endif ?> 
            <span><?php echo htmlspecialchars($user['firstname'])." ".htmlspecialchars($user["lastname"]) ?></span>
        </div> 
            <span><?php echo count($friends)?> <br> friends</span>
            <span><?php echo count($posts)?> <br> posts</span>
    </div>
    <?php
    if ($me)
        include "shared/make.php";
    else 
        echo '<div class="inter">
                <div><i class="fa-solid fa-user-plus"></i> Add friend</div>
                <div><i class="fa-solid fa-message"></i> Send message</div>
             </div>';
    
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
                <div class="person">
                    <span> <?php if($post['repost']) echo " repost from " .$post['repost']; ?> </span>
                    <i class="fa-solid fa-ellipsis-v"></i>
                </div>
                <span style="margin: 2px;">
                <?php echo htmlspecialchars($post["text"]) ?>
                &nbsp;</span>
                <img src="<?php if($post["image"]) echo "https://res.cloudinary.com/dg1vm1zpr/image/upload/v1687615647/".htmlspecialchars($post["image"]) ?>" alt="">
                <div class="inter-count">
                    <div></i> <?php echo htmlspecialchars($likes) ?> Likes</div>
                    <div></i> <?php echo htmlspecialchars($comments) ?> Comments</div>
                    <div></i> <?php echo htmlspecialchars($shares) ?> Shares</div>
                </div>
                <div class="inter">
                    <button  <?php if($liked) echo 'data-done'; ?> onclick="handlelike(event, <?php echo $id?>,<?php echo $userid?>)"><i class="fa-solid fa-thumbs-up"></i> Like</button> 
                    <button onclick = "handleshowcomments(event, <?php echo $id?>,<?php echo $userid?>)"><i class="fa-solid fa-comment"></i> Comment</button>
                    <button <?php if($shared) echo 'data-done'; ?> onclick = "handleshare(event, <?php echo $id?>,<?php echo $userid?>)"><i class="fa-solid fa-share"></i> Share</button>
                </div>
                <div class="comments">
                </div>
            </div>
    <?php  endforeach ?>
</div>

<div id="dms">
    <h1> Messages: </h1>
    <div class="dm-bar">    
        <div class="contact" online> </div>
        <div class="contact"> </div>
        <div class="contact"> </div>
        <div class="contact selected" online></div>
        <div class="contact" online> </div>
        <div class="contact"> </div>
        <div class="contact"> </div>
        <div class="contact"> </div>
        <div class="contact" online> </div>
    </div>
    <span>first last <i style="color: #0b0;">(online)</i></span>
    <div class="mess">
        <div class="cont">
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, qui nihil! Suscipit at placeat harum quisquam eius recusandae, inventore eaque ducimus hic dolor mollitia tempora eveniet accusantium ratione magnam aut.</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, qui nihil! Suscipit at placeat harum quisquam eius recusandae, inventore eaque ducimus hic dolor mollitia tempora eveniet accusantium ratione magnam aut.</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">:kjajz!bl majnm   jkenùalzkrjmaùzkeamzekm</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="sent">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo modi totam beatae commodi fuga reiciendis excepturi laborum magni impedit officia?</div>
            <div class="rec">kljsmekrktapjozjprjaipifjoajfoaizjeoaùkldn,</div>
            <div class="rec">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, qui nihil! Suscipit at placeat harum quisquam eius recusandae, inventore eaque ducimus hic dolor mollitia tempora eveniet accusantium ratione magnam aut.</div>
        </div>
        <div class="text" contenteditable placeholder="Message..."></div>
        <i class="fa-solid fa-share-from-square"></i>
    </div>
</div>
</section>
<?php require "shared/footer.php"  ?>
<script src = "front-end/interactionHandler.js" defer></script>
</html>

