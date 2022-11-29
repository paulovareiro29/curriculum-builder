<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("head.php"); ?>

    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/landing.css" />
    <title>Curriculum Builder</title>
</head>

<body>
    <?php require_once("navbar.php") ?>

    <div class="container">
        <section id="landing" class="full-page">
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

        </section>
    </div>
</body>

</html>