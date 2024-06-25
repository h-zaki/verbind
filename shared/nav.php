<?php

$thisuser = fetch($conn, "SELECT * from user where id = $userid")[0];

?>



<nav>
            <a href="profile.php" class="myprofile"> 
                 <?php if($thisuser['image']): ?>
                  <div class= "pic-container"> <img src="<?php echo $thisuser['image']?>" alt=""> </div>
                 <?php    else: ?>   
                  <div class= "pic-container">  <img src="images/Account.webp" alt=""> </div>
                 <?php    endif ?> 
                <div><?php echo $thisuser['firstname']." ".$thisuser['lastname']; ?></div> 
            </a>
            <a href="home.php" <?php if ($currentPage === 'home') echo "selected"; ?>><i class="far fa-window-maximize" ></i> Feed</a>
            <a href="friends.php" <?php if ($currentPage === 'friends') echo "selected"; ?>><i class="fa-solid fa-user-friends" ></i> Friends</a>
            <a href="search.php" <?php if ($currentPage === 'search') echo "selected"; ?>><i class="fa-solid fa-search" ></i> search</a>
            <button class="signout" onclick="window.location.pathname = '/'"> <i class="fa-solid fa-sign-out"></i> Sign out </button>
</nav>