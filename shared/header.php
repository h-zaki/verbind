<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verbind</title>
    <link rel="icon" href="./images/Logo.svg">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body> 
    <header>
        <a href="home.php"><img src="images/Logo.svg" alt="Verbind"></a>
        <form class="search-bar" method="get" action="search.php">
            <input type="text" placeholder="search..." name = "value" value="<?php echo isset($_GET['value'])? $_GET['value']:''  ?>">
            <button type="submit"><i class="fa-solid fa-search"></i></button>
        </form> 
        <!-- <button class="person"> <img src="images/Account.webp" alt=""> </button> -->
        <button class="notifs"> <i class="far fa-bell"></i></button>
    </header>