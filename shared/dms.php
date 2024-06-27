<?php session_start()  ?> 
<script>

    const me = <?php echo $_SESSION["user"] ?>;
    var them = <?php echo $_SESSION['conversation']? $_SESSION['conversation'] :"null" ?>;

</script>



<div id="dms">
    <h3>Write a message: <i class= "unload"></i></h3>
    <div class="person" >
            
    </div>
    <div class="mess">
        <div class="cont"></div>

        <form class= "message-form">
            <input class="text" type="text" placeholder="Message..." name="message" disabled>
            <input class="send" required="true" type="submit" value="send" autocomplete="off" disabled></i>  
        </form>
    </div>
</div>    

<script src = "front-end/messaging.js" type="module" defer></script>