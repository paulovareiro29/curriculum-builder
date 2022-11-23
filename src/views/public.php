<?php 


  $list = CurriculumController::index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("head.php"); ?>

    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/landing.css" />
    <title>Curriculum Builder</title>
  </head>
<body>
  <?php require_once("navbar.php")?>

  <div class="landing main-container container">
    <div class="curriculums">
    <h1 class="title">Public Curriculums</h1>
      <div class="curriculums-list">

        <?php if(!$list || sizeof($list) <= 0):?>
          <div class="empty-state">
            <img src="/<?=$_ENV['SRC_DIR']?>/assets/images/file.svg" alt="">
            <h3>No Curriculums Found.</h3>
            <p>It seems like there are no public curriculums, yet! Why aren't you the first to create one?</p>
          </div>
        <?php endif;?>

        <?php foreach($list as $curriculum):?>
          <?php $curriculum['user'] = UserController::get($curriculum['user_id'])?>
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
</body>
</html>