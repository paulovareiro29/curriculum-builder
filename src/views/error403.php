<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("head.php"); ?>
    
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/error403.css" />
    <title>Curriculum Builder</title>
  </head>
  <body>
    <div class="error403 container">
      <h1>Sorry!</h1>
      <h5>FORBIDDEN</h5>
      <p>
        Sorry! The page you are trying to access a has restricted access.
        Please refer to your system administrator.
      </p>
      <a class="btn" href="/<?=$_ENV["BASE_DIR"] ?>/">GO HOME</a>
    </div>
  </body>
</html>