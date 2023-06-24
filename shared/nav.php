<nav>
         <ul>
            <li class="page <?php if ($currentPage === 'home') echo "selected"; ?>"><a class="fa-solid fa-home" href="home.php"></a></li>
            <li class="page <?php if ($currentPage === 'search') echo "selected"; ?>"><a class="fa-solid fa-search" href="search.php"></a></li>
            <li class="page <?php if ($currentPage === 'messages') echo "selected"; ?>"><a class="fa-solid fa-comment-dots" href="messages.php"></a></li>
            <li class="page <?php if ($currentPage === 'profile') echo "selected"; ?>"><a class="fa-solid fa-user" href="profile.php"></a></li>
         </ul>
</nav>