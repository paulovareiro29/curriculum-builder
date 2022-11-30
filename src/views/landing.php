<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__ROOT__ . "/layout/head.php"); ?>

    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/landing.css" />
    <title>Curriculum Builder</title>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>
<section id="landing" class="full-page">
    <div class="container">
        <div class="content">
            <h2>Build your own</h2>
            <h1>Curriculum</h1>
            <p>Creating a curriculum vitae can be overwhelming, especially when you have to do it all by yourself. You can also check other people curriculums or make yours public for everyone to see!</p>
            <p>This platform was built as an <strong>university project.</strong></p>
            <div class="cta">
                <a href="/<?= $_ENV["BASE_DIR"] ?>/login" class="btn btn-primary">Sign In</a>
                <a href="/<?= $_ENV["BASE_DIR"] ?>/register" class="btn btn-outline">Create an account</a>
            </div>
        </div>

        <img src="/<?= $_ENV['SRC_DIR'] ?>/assets/images/cv.png" alt="" class="banner">
    </div>
</section>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>