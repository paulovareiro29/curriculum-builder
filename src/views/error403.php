<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once(__ROOT__ . "/layout/head.php"); ?>

  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/error403.css" />
  <title>Curriculum Builder</title>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<div class="container d-flex justify-center">
  <div class="error403">
    <h1>Sorry!</h1>
    <h5>FORBIDDEN</h5>
    <p>
      Sorry! The page you are trying to access a has restricted access.
      Please refer to your system administrator.
    </p>
    <a class="btn" href="/<?= $_ENV["BASE_DIR"] ?>/">GO HOME</a>
  </div>
</div>
<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/lib/jquery.js"></script>
<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/script.js"></script>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>