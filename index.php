<?php



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Verbind</title>
</head>
<body >
    <div class="login-outer-container">
        <div class="login-container">
            <img src="images/Logo.png" alt="">
            
            <form action="<?php echo __DIR__?>/home.php" method="post">
                <legend>Login</legend>
                <input placeholder="username" type="text" name="username" >
                <input placeholder="password" type="password" name="password">
                <br>
                <input type="submit" value="login">
                <span>you have an account ?
                    <a href = "signup.php">sign up</a></span>
            </form>
        </div>
    </div>
</body>
</html>