
<script>

    const me = <?php echo $_SESSION["user"] ?>;
    var them = null;

</script>



<div id="dms">
    <h3>Write a message:</h3>
    <div class="person" >
            
    </div>
    <div class="mess">
        <div class="cont"></div>

        <form class= "message-form">
            <input class="text" type="text" placeholder="Message..." name="message" disabled>
            <input class="send" required="true" type="submit" value="send" autocomplete="off" disabled></i>  
        </form>
    </div>
    <!-- <div class="person" >
            <a href = "profile.php?id=<?php echo $person['id']?>">  
                <img src="images/Account.webp" alt="">
            <span>first last</span>
            </a>
    </div>
    <div class="mess">
        <div class="cont"></div>

        <form class= "message-form">
            <input class="text" type="text" placeholder="Message..." name="message">
            <input class="send" required="true" type="submit" value="send" autocomplete="off"></i>  
        </form>
    </div> -->
</div>    

<script src = "front-end/messaging.js" type="module" defer></script>