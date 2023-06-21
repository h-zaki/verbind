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
           
            <form action="./home.php" method="post">
                <legend>Sign Up</legend>
                <input placeholder="first name" type="text" name="first">
                <input placeholder="last name" type="text" name="last">
                <input placeholder="username" type="text" name="username" >
                <input placeholder="password" type="password" name="password">
                <br>
                <input type="submit" value="sign up">
                <span>you have an account ?
                    <a href = "index.php">login</a></span>
            </form>
        </div>
    </div>
</body>
</html>