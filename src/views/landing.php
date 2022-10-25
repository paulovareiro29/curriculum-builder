<?php 


  $list = CurriculumController::index();
?>

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
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/landing.css" />
    <title>Paulo Vareiro n24473</title>

    <script src="https://kit.fontawesome.com/be947b2e4a.js" crossorigin="anonymous"></script>
  </head>
<body>


  <div class="navbar">
    <div class="navbar-wrapper">
      <div>
        <a href="./">Home</a>
        <a href="./backoffice">Dashboard</a>
      </div>
      
        <div>
          <?php if(AuthController::isLoggedIn()):?>
            <p>Logged in as <b><?php echo $_SESSION["user"]; ?></b></p>
            <a href="/<?=$_ENV["BASE_DIR"] ?>/logout">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
          <?php else:?>
            <a href="/<?=$_ENV["BASE_DIR"] ?>/login">
              Login
            </a>
          <?php endif;?>
        </div>
  
    </div>
  </div>

  <div class="landing main-container">
    <div class="curriculums">
    <h1>Public Curriculums</h1>
      <div class="curriculums-list">

        <?php if(!$list || sizeof($list) <= 0):?>
          <div class="empty-state">
            <img src="/<?=$_ENV['SRC_DIR']?>/assets/images/file.svg" alt="">
            <h3>No Curriculums Found.</h3>
            <p>It seems like there are no public curriculums, yet! Why aren't you the first to create one?</p>
          </div>
        <?php endif;?>

        <?php foreach($list as $curriculum):?>
          <?php $curriculum['user'] = UserController::get($curriculum['id'])?>
          <div class="curriculum" data-id="<?=$curriculum['id']?>">
            <div class="curriculum-body">
              <div class="curriculum-avatar">
                <img src="<?=$curriculum['avatar'];?>" alt="">
              </div>
              <div class="curriculum-info">
                <h3><?= $curriculum['name']?></h3>
                <p><?= $curriculum['description']?></p>
              </div>
            </div>
            <div class="curriculum-options">
              <p class="curriculum-user">By: <b><?= $curriculum['user']['username']?></b></p>
              <a class="icon" href="/<?=$_ENV["BASE_DIR"] ?>/view?id=<?=$curriculum['id']?>">
                <i class="fa-solid fa-eye"></i>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <?php if(!AuthController::isLoggedIn()): ?>
    <a class="floating-button" href="./login">
      <i class="fa fa-user-circle"></i>
    </a>
  <?php endif; ?>

</body>
</html>