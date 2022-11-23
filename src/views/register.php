<?php 
  if(AuthController::isLoggedIn()){
    AuthController::redirectToIndex();
  }

  function register($username, $password) {
    if(UserController::getByUsername($username) != null) {
        return "Username already exists";
    }

    if(UserController::create($username, $password)) {
        AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/login");
        return "";
    }

    return "Failed to create an account";
  }

  $msg = "";
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $msg = register($username, $password);
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("head.php"); ?>
        
        <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/register.css" />
        <title>Curriculum Builder</title>
    </head>
    <body>
        <?php require_once("navbar.php")?>

        <div class="container d-flex justify-center">
            <div class="register">
                <div class="register-header">
                    <h1>Sign Up For Free</h1>
                    <p>Create an account and start creating curriculums</p>
                    <?php 
                        if($msg !== "") echo "<p class=\"color-danger\">{$msg}</p>";
                    ?>
                    </div>


                    <form action="#" method="POST" id="register-form">
                        <div class="form-row">
                            <div class="form-group">
                            <label for="username">Username</label>
                            <input
                                type="text"
                                name="username"
                                id="username"
                                placeholder="Username"
                                required
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
                                required
                            />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input
                                type="password"
                                name="confirm_password"
                                id="confirm_password"
                                placeholder="Confirm Password"
                                required
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

        <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/register.js"></script>
    </body>
</html>
