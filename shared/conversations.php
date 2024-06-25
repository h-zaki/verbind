<?php 

    include_once 'functions/fetch.php';
    include_once 'functions/friends.php';

    $friends = friends($conn,$_SESSION["user"]);

?> 


<div id="convs">
    <h3>Contacts:</h3>
</div>   

<script defer type="module">
    import {updateContacts} from "./front-end/messaging.js"


    <?php foreach ($friends as $friend) : ?>
       updateContacts(<?php echo $friend["id"] ?>)
    <?php endforeach ?>   
</script>