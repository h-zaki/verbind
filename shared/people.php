


<?php
include_once 'functions/friends.php';


$people = fetch($conn,"SELECT * from user where id <> $userid and id not in
                      ((SELECT f1 AS id FROM friend where f1 = $userid or f2 = $userid) 
                      UNION (SELECT f2 AS id FROM friend where f1 = $userid or f2 = $userid) 
                      UNION (SELECT sender AS id FROM friend_request where sender = $userid or receiver = $userid) 
                      UNION (SELECT receiver AS id FROM friend_request where sender = $userid or receiver = $userid)
                      )
                      limit 4");
?>




<div id="discover">
    <h3>People you may know:</h3>
    <?php  if(!count($people)):
        echo "<br>no users found <br><br>";
      else:
    foreach ($people as $person): ?>
        <div class="person" >
            <a href = "profile.php?id=<?php echo $person['id']?>">
            <?php if($person['image']): ?>
                <img src="<?php echo $person['image']?>" alt="">
            <?php    else: ?>   
                <img src="images/Account.webp" alt="">
            <?php    endif ?> 
            <span><?php echo htmlspecialchars($person['firstname'])." ".htmlspecialchars($person["lastname"]) ?></span>
            </a>
            <button onclick="handlerequestfriend(event ,<?php echo $userid ?>,<?php echo $person['id'] ?> ,(element,s,r)=>interact(sendrequest,[element,s,r]))"> <i class="fa-solid fa-user-plus"></i> </button>
        </div>
    <?php endforeach ?>
    <button onclick="window.location.replace('search.php')"> See more</button>
    <?php endif ?>
</div>    

<script src = "front-end/friendHandler.js" defer></script>
<script>
    const sendrequest = (element,s,r,callback)=>
    {
        element.parentElement.parentElement.removeChild(element.parentElement)
        const notifData = {actor: myName, 	image:myImage, 	seen:false, 	target:r, 	 	type:'friend', 	typeId:s, }
        callback({...notifData,number:1})
    }
</script>
<script defer type="module">
    import {sendNotification} from "./front-end/notifications.js"

    window.interact = (func,params) =>
    {
        func(...params,sendNotification)
    } 


</script>