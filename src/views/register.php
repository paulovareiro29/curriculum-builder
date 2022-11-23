<?php 
  if(AuthController::isLoggedIn()){
    AuthController::redirectToIndex();
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

        <div class="container">
            
        </div>
    </body>
</html>
