<?php 
    $currentPage = 'home';
    include 'config/database.php';
    include 'functions/fetch.php';

    $userid = 21;

    $posts = fetch($conn,"SELECT * from (SELECT p.*, u.firstname,u.lastname,u.image pimage,'' repost  from post p JOIN user u on u.id = p.userid 
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
require "shared/nav.php"
?>
<section id="content">

<?php include 'shared/people.php'?>

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
                <div class="person">
                  <a  href = "profile.php?id=<?php echo $post['userid']?>">  
                    <img src="<?php if($post['pimage']) echo  $post['pimage'];
                         else    echo"images/Account.png;" ?>" alt="">
                    <span><?php echo htmlspecialchars($post['firstname'])." ".htmlspecialchars($post['lastname']);  
                           if($post['repost']) echo " repost from " .$post['repost'];          ?> </span>
                    </a>
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



<?php require "shared/footer.php"?>

<script src = "front-end/interactionHandler.js" defer></script>

</html>

