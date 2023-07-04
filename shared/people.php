


<?php
$people = fetch($conn,"SELECT * from user where id <> $userid and id not in
                      (SELECT u.id from user u join friend f on u.id = f.f1 where f2 = $userid union SELECT u.id from user u join friend f on u.id = f.f2 where f1 = $userid) 
                      limit 10");
?>




<div id="discover">
    <h3>People you may know:</h3>
    <?php  if(!count($people)):
        echo "<br>no users found <br><br>";
      else:
    foreach ($people as $person) : 
        $person = $people[0] ?>
        <div class="person" >
            <a href = "profile.php?id=<?php echo $person['id']?>">
            <?php if($person['image']): ?>
                <img src="<?php echo $person['image']?>" alt="">
            <?php    else: ?>   
                <img src="images/Account.webp" alt="">
            <?php    endif ?> 
            <span><?php echo htmlspecialchars($person['firstname'])." ".htmlspecialchars($person["lastname"]) ?></span>
            </a>
            <button> <i class="fa-solid fa-user-plus"></i> </button>
        </div>
    <?php endforeach ?>
    <button onclick="window.location.replace('search.php')"> See more</button>
    <?php endif ?>
</div>    