<?php
  include 'config/database.php';
  include 'functions/fetch.php';
  require_once 'config/firebase.php';

  $error = "";

  session_start();


  if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["first"]) && isset($_POST["last"])){

    try {
      
      
      $email =  htmlspecialchars($_POST["email"]);
      $password = htmlspecialchars($_POST["password"]);
      

      $user = $auth->createUserWithEmailAndPassword($email, $password);

      $firebaseId = htmlspecialchars($user->uid);
      $firstname = htmlspecialchars($_POST["first"]);
      $lastname = htmlspecialchars($_POST["last"]);

      

      save($conn,"INSERT into user(email , firstname, lastname, firebase_id) VALUES ('$email' , '$firstname', '$lastname','$firebaseId')");
      header('Location: index.php');

    } catch (Exception $e) {
      $error = $e->getMessage();
    }

  }

?>


<!DOCTYPE html>
<html lang="en">
<?php  require "shared/header.php"; ?>
    <div class="login-outer-container">
        <div class="login-container">
            <img src="images/Logo.png" alt="">
           
            <form method="post">
                <span style="color: red;"> <?php echo $error; ?> </span>
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