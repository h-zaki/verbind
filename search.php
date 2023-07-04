<?php 
    $currentPage = 'search';
    include 'functions/fetch.php';
    include 'config/database.php';

    $userid = 21;
    $searchParams = ["","",""];
    $value = "";
    if(isset($_GET['value']))
    {
        $value = mysqli_real_escape_string($conn,$_GET["value"]);
        $values = explode(" ",$value);
        $filler = array_fill(0,(count($values)<=3)? 3-count($values): 0, "");
        $searchParams = array_merge($values,$filler);
    }
    $invalid = strlen($searchParams['2']);
    $people = fetch($conn,"SELECT * from user where id <> $userid and 
    (firstname like('%{$searchParams["0"]}%') and lastname like('%{$searchParams["1"]}%') or
    firstname like('%{$searchParams["1"]}%') and lastname like('%{$searchParams["0"]}%'))
    and not $invalid
    ");

    $posts = fetch($conn, "SELECT p.*, u.firstname,u.lastname,u.image pimage from post p join user u on u.id = p.userid where userid != $userid and text like('%$value%')")
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
<div id = "feed">

            <h3>People:</h3>
            <br>
            <div id="people">
            <?php  if(!count($people)):
                echo "<span class='profile-announce'> no users found <span>";
            else:
            foreach ($people as $person):?>
                <div class="person" >
                    <a href = "profile.php?id=<?php echo $person['id']?>">
                    <?php if($person['image']): ?>
                        <img src="<?php echo $person['image']?>" alt="">
                    <?php    else: ?>   
                        <img src="images/Account.webp" alt="">
                    <?php    endif ?> 
                    <span><?php echo htmlspecialchars($person['firstname'])." ".htmlspecialchars($person["lastname"]) ?></span>
                    </a>
                </div>
            <?php endforeach ?>
            <?php endif ?>
            </div>
<h3>Posts:</h3>

<?php 
      if(!count($posts)) echo "<span class='profile-announce'> no posts found <span>";
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
                    <img src="<?php if($post['pimage']) echo  $post['pimage'];
                         else    echo"images/Account.webp;" ?>" alt="">
                    <span><?php echo htmlspecialchars($post['firstname'])." ".htmlspecialchars($post['lastname']);?> </span>
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
                                <?php echo htmlspecialchars($comments) ?> Comments</button>
                    <button <?php if($shared) echo 'data-done'; ?> onclick = "handleshare(event, <?php echo $id?>,<?php echo $userid?>)"><i class="fas fa-share"></i> 
                                <span><?php echo htmlspecialchars($shares) ?>  Shares</span></button>
                </div>
                <div class="comments">
                </div>
        </div>
    <?php  endforeach ?>


</div>

<aside>  
    <div></div>
    <?php include "shared/dms.php";?>
</aside>
    
    <?php
    include "shared/conversations.php"
    ?>
</div>
</section>
<?php require "shared/footer.php"  ?>

<script src = "front-end/interactionHandler.js" defer></script>

</html>