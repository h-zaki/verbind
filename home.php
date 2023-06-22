<?php 
    include 'functions/fetch.php';
    $currentPage = 'home';
    //databese connection
    $conn = mysqli_connect('localhost','verbind','password','verbinf');
    if(!$conn)
        echo "Connextion error" . mysqli_connect_error();
    //getting posts
     $posts = fetch($conn,"SELECT p.*, u.firstname,u.lastname from post p JOIN user u on u.id = p.userid ORDER BY time desc");

?>


<!DOCTYPE html>
<html lang="en" spellcheck="false">
<?php  
require "templates/header.php"; 
require "templates/nav.php"
?>
<section id="content">
<div id="discover">
    <h1>People you may know:</h1>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>
    <div class="person">
        <div>
        <img src="images/Account.png" alt="">
        <span>first last</span>
        </div>
        <i class="fa-solid fa-user-plus"></i>
    </div>

    <button onclick="window.location.replace('search.php')"><i class="fa-solid fa-search"></i> more users</button>
</div>    

<div id ="feed">
    <div class="make">
        <div id="textarea" contenteditable placeholder="write something..." spellcheck="false"></div>
      <div class="inter">
        <div><i class="fa-solid fa-camera"></i> Add image</div>
        <div><i class="fa-solid fa-share"></i> Share</div>
       </div>
    </div>


    <?php foreach ($posts as $post) { 
        $id = $post["id"];
        $likes = fetch($conn,"SELECT count(*) nbr from liked where postid = $id")[0]["nbr"];
        $comments = fetch($conn,"SELECT count(*) nbr from comment where postid = $id")[0]["nbr"];
        $shares = fetch($conn,"SELECT count(*) nbr from repost where postid = $id")[0]["nbr"];
        ?>
        <div class="f-element">
                <div class="person">
                    <div>
                    <img src="images/Account.png" alt="">
                    <span><?php echo htmlspecialchars($post['firstname'])." ".htmlspecialchars($post['lastname']) ?> </span>
                    </div>
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
                <div class="inter">
                    <div><i class="fa-solid fa-thumbs-up"></i> Like</div>
                    <div><i class="fa-solid fa-comment"></i> Comment</div>
                    <div><i class="fa-solid fa-share"></i> Share</div>
                </div>
            </div>
    <?php  } ?>
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
<?php require "templates/footer.php"  ?>
</html>


<?php
//closing the connexion
mysqli_close($conn);
?>