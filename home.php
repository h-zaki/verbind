<?php 
    $currentPage = 'home';
    include 'config/database.php';
    include 'functions/fetch.php';
    include 'functions/friends.php';

    $userid = 21;
    

    $posts = fetch($conn,"SELECT p.*, u.firstname,u.lastname,u.image pimage from post p JOIN user u on u.id = p.userid where u.id in 
                          (SELECT u.id from user u join friend f on u.id = f.f1 where f2 = $userid union SELECT u.id from user u join friend f on u.id = f.f2 where f1 = $userid)
                           ORDER BY time desc");
    
    if(isset($_POST['Like'])){
            $postid =  $_POST['Like'];
            save($conn,"INSERT into liked(userid,postid) VALUES ($userid,$postid)");
            header('Location: home.php');
      }
    if(isset($_POST['Dislike'])){
            $postid =  $_POST['Dislike'];
            save($conn,"DELETE FROM liked WHERE userid = $userid and postid = $postid");
            header('Location: home.php');
      }

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
    <div class="make">
        <div id="textarea" contenteditable placeholder="write something..." spellcheck="false"></div>
      <div class="inter">
        <div><i class="fa-solid fa-camera"></i> Add image</div>
        <div><i class="fa-solid fa-share"></i> Share</div>
       </div>
    </div>


    <?php foreach ($posts as $post) : 
        $id = $post["id"];
        $likes = fetch($conn,"SELECT count(*) nbr from liked where postid = $id")[0]["nbr"];
        $liked = fetch($conn,"SELECT userid from liked where postid = $id and userid = $userid");
        $comments = fetch($conn,"SELECT count(*) nbr from comment where postid = $id")[0]["nbr"];
        $shares = fetch($conn,"SELECT count(*) nbr from repost where postid = $id")[0]["nbr"];
        ?>
        <div class="f-element">
                <div class="person">
                  <a  href = "profile.php?id=<?php echo $post['userid']?>">  
                    <img src="<?php if($post['pimage']) echo  $post['pimage'];
                         else    echo"images/Account.png;" ?>" alt="">
                    <span><?php echo htmlspecialchars($post['firstname'])." ".htmlspecialchars($post['lastname']) ?> </span>
                    </a>
                    <i class="fa-solid fa-ellipsis-v"></i>
                </div>
                <span style="margin: 2px;">
                <?php echo htmlspecialchars($post["text"]) ?>
                &nbsp;</span>
                <img src="<?php echo htmlspecialchars($post["image"]) ?>" alt="">
                <div class="inter-count">
                    <div></i> <?php echo htmlspecialchars($likes) ?> Likes</div>
                    <div></i> <?php echo htmlspecialchars($comments) ?> Comments</div>
                    <div></i> <?php echo htmlspecialchars($shares) ?> Shares</div>
                </div>
                <form class="inter" method="post">
                  <?php if (!$liked):  ?> 
                    <button name = "Like"  value ="<?php echo htmlspecialchars($id)?>"><i class="fa-solid fa-thumbs-up"></i> Like</button>
                  <?php else:  ?>   
                    <button name = "Dislike"  value ="<?php echo htmlspecialchars($id)?>" class="done" ><i class="fa-solid fa-thumbs-up"></i> Liked</button>
                  <?php endif  ?>     
                    <button name = "comment" ><i class="fa-solid fa-comment"></i> Comment</button>
                    <button name = "Like"  ><i class="fa-solid fa-share"></i> Share</button>
                </form>
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
</html>


<?php
//closing the connexion
mysqli_close($conn);
?>