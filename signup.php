<?php

  if(isset($_POST['submit'])){

  }

?>


<!DOCTYPE html>
<html lang="en">
<?php  require "shared/header.php"; ?>
    <div class="login-outer-container">
        <div class="login-container">
            <img src="images/Logo.png" alt="">
           
            <form action="./home.php" method="post">
                <legend>Sign Up</legend>
                <input placeholder="first name" type="text" name="first">
                <input placeholder="last name" type="text" name="last">
                <input placeholder="email" type="email" name="email" >
                <input placeholder="password" type="password" name="password">
                <br>
                <input type="submit" value="sign up">
                <span>you have an account ?
                    <a href = "index.php">login</a></span>
            </form>
        </div>
    </div>
<?php require "shared/footer.php"  ?>
</html>