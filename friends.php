<?php 
    $currentPage = 'friends';
    include 'functions/fetch.php';
    include 'functions/friends.php';
    include 'config/database.php';

    $userid = 21;

    $personId = $userid;
    if(isset($_GET['id']))
        $personId = $_GET['id'];
  
    $friends = friends($conn,$personId);
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

            <h3>Friends:</h3>
            <br>
            <div id="people">
            <?php  if(!count($friends)):
                echo "<span class='profile-announce'> no users found <span>";
            else:
            foreach ($friends as $person):?>
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
</div>

<aside>  
    <?php include "shared/people.php";?>
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