
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("head.php"); ?>
    
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/error404.css" />
    <title>Curriculum Builder</title>
  </head>
  <body>
    <div class="container d-flex justify-center">
      <div class="error404">
        <h1>Oops!</h1>
        <h5>PAGE NOT FOUND!</h5>
        <p>
          Uh oh, we can't seem to find the page you're looking for. It might
          have been removed, renamed, or did not exist in first place.
        </p>
        <a class="btn" href="/<?=$_ENV["BASE_DIR"] ?>/">GO HOME</a>
      </div>
    </div>
    
    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/lib/jquery.js"></script>
    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/script.js"></script>
  </body>
</html>