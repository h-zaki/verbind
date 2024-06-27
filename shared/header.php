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
        <div class="notifs">
            <button> <i class="far fa-bell"></i> </button>
            <div class="notif-container">
            </div>
        </div> 
    </header>

    <script>
        const userid = <?php echo ($_SESSION["user"]? $_SESSION["user"]: "null") ?>;
        document.querySelector(".notifs button").addEventListener("click",(event)=>{
            const target = event.target.nextElementSibling? event.target: event.target.parentElement
            if(!target.classList.contains("unrolled")){
                target.classList.add("unrolled");
                target.nextElementSibling.style.visibility = "visible"
                target.innerHTML = 'x'
            }else{
                target.classList.remove("unrolled");
                target.nextElementSibling.style.visibility = "hidden"
                target.innerHTML = '<i class="far fa-bell"></i>'
            }

        })
    </script>


    <script src = "front-end/notifications.js" type="module" defer></script>