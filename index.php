<?php
  include 'config/database.php';
  include 'functions/fetch.php';
  require_once 'config/firebase.php';


  $error = "";

  session_start();

  unset($_SESSION['user']);

  if(isset($_POST["email"]) && isset($_POST["password"])){
    $email =  htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);


    try {
      $signInResult = $auth->signInWithEmailAndPassword($email, $password);
  
      $user = $signInResult->data();

      $firebaseId = $user['localId'];

      $user = fetch($conn,"SELECT id FROM user WHERE firebase_id = '$firebaseId'");

      $_SESSION["user"] = $user[0]["id"];
  
    } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $e) {
        $error = 'The password is invalid.';
    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        $error = 'The user was not found.';
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
  }

  if($_SESSION["user"])
      header('Location: home.php');

?>



<!DOCTYPE html>
<html lang="en">
<?php  require "shared/header.php"; ?>
    <div class="login-outer-container">
        <div class="login-container">
            <img src="images/Logo.png" alt="">
            
            <form method="post">
                <span style="color: red;"> <?php echo $error; ?> </span>
                <legend>Login</legend>
                <input placeholder="email" type="email" name="email"  required>
                <input placeholder="password" type="password" name="password" required>
                <br>
                <input type="submit" value="login">
                <span>you have an account ?
                    <a href = "signup.php">sign up</a></span>
            </form>
        </div>
    </div>
<?php require "shared/footer.php"  ?>
</html>