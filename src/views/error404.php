
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/style.css" />
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/error404.css" />
    <title>Curriculum Builder</title>

    <script src="https://kit.fontawesome.com/be947b2e4a.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="error404 container">
      <h1>Oops!</h1>
      <h5>PAGE NOT FOUND!</h5>
      <p>
        Uh oh, we can't seem to find the page you're looking for. It might
        have been removed, renamed, or did not exist in first place.
      </p>
      <a class="btn" href="/<?=$_ENV["BASE_DIR"] ?>/">GO HOME</a>
    </div>

    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/lib/jquery.js"></script>
    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/script.js"></script>
  </body>
</html>