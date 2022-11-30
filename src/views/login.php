<?php

if (AuthController::isLoggedIn()) {
  AuthController::redirectToIndex();
}

$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $msg = "Incorrect username / password";

  if (UserController::validate($username, $password)) {
    $_SESSION["user"] = $username;
    AuthController::redirectToIndex();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once(__ROOT__ . "/layout/head.php"); ?>

  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/login.css" />
  <title>Curriculum Builder</title>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>

<div class="container d-flex justify-center">
  <div class="login">
    <div class="login-header">
      <h1>Sign In</h1>
      <p>Please enter your account details.</p>
      <?php
      if ($msg !== "") echo "<p class=\"color-danger\">{$msg}</p>";
      ?>
    </div>


    <form action="#" method="POST">
      <div class="form-row">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="Username" required />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Password" required />
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
<?php require_once(__ROOT__ . "/layout/footer.php") ?>