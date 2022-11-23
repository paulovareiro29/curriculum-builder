<?php

  if(AuthController::isLoggedIn()){
    AuthController::redirectToIndex();
  }

  $msg = "";
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $msg = "Incorrect username / password";

    if(UserController::validate($username, $password)) {
      $_SESSION["user"] = $username;
      AuthController::redirectToIndex();
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("head.php"); ?>

    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/login.css" />
    <title>Curriculum Builder</title>
  </head>
  <body>
    <a class="floating-button floating-button-left" href="/<?= $_ENV['BASE_DIR']?>">
      <i class="fa fa-arrow-left"></i>  
    </a>
    <div class="w-100 d-flex justify-center align-center container">
      <div class="login">
        <div class="login-header">
        <h1>Login Panel</h1>
          <p>Sign in to your account</p>
          <?php 
            if($msg !== "") echo "<p class=\"color-danger\">{$msg}</p>";
          ?>
        </div>


        <form action="#" method="POST">
          <div class="form-row">
            <div class="form-group">
              <label for="username">Username</label>
              <input
                type="text"
                name="username"
                id="username"
                placeholder="Username"
              />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                name="password"
                id="password"
                placeholder="Password"
              />
            </div>
          </div>
          <div class="form-row">
            <button type="submit">SUBMIT</button>
          </div>
        </form>

        <div class="copyright">
          <p><small>Paulo Vareiro @ 2022 All Rights Reserved</small></p>
        </div>
      </div>
    </div>
  </body>
</html>
