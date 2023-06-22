<?php
  if(isset($_POST['submit'])){
    $email =  htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    header('Location: home.php');
  }

?>



<!DOCTYPE html>
<html lang="en">
<?php  require "templates/header.php"; ?>
    <div class="login-outer-container">
        <div class="login-container">
            <img src="images/Logo.png" alt="">
            
            <form action="index.php" method="post">
                <legend>Login</legend>
                <input placeholder="email" type="email" name="email"  required>
                <input placeholder="password" type="password" name="password" required>
                <br>
                <input type="submit" name="submit" value="login">
                <span>you have an account ?
                    <a href = "signup.php">sign up</a></span>
            </form>
        </div>
    </div>
<?php require "templates/footer.php"  ?>
</html>