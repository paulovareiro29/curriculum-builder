<?php


$list = CurriculumController::index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once(__ROOT__ . "/layout/head.php"); ?>

  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/landing.css" />
  <title>Curriculum Builder</title>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>

<div class="modal guide-modal" id="guide-showcase">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p>Here is where you can see all public curriculums on showcase. You can also create your own and showcase it. To do so you need to make it <strong>public</strong>:</p>
        <p>1) Go to <strong>dashboard</strong></p>
        <p>2) Click on <i class="fa-solid fa-pen-to-square color-warning"></i></p>
        <p>3) General > <strong>Showcase curriculum</strong> <i class="fa-solid fa-check color-success"></i></p>
      </div>
      <button type="button" class="btn btn-md" onclick="closeModal('guide-showcase')">GOT IT</button>
    </div>
  </div>
</div>

<div class="landing main-container container">
  <div class="curriculums">
    <div class="d-flex align-center gap-8 mb-16">
      <h1>Showcase</h1>
      <button type="button" onclick="showModal('guide-showcase')" class="btn btn-circle-md guide-btn">?</button>
    </div>
    <div class="curriculums-list">

      <?php if (!$list || sizeof($list) <= 0) : ?>
        <div class="empty-state">
          <img src="/<?= $_ENV['SRC_DIR'] ?>/assets/images/file.svg" alt="">
          <h3>No Curriculums Found.</h3>
          <p>It seems like there are no curriculums to showcase, yet! Why aren't you the first to create one?</p>
        </div>
      <?php endif; ?>

      <?php foreach ($list as $curriculum) : ?>
        <?php $curriculum['user'] = UserController::get($curriculum['user_id']) ?>
        <div class="curriculum" data-id="<?= $curriculum['id'] ?>">
          <div class="curriculum-body">
            <div class="curriculum-avatar">
              <img src="<?php if (empty($curriculum['avatar'])) {
                          echo "/{$_ENV["SRC_DIR"]}/assets/images/avatar.png";
                        } else {
                          echo $curriculum['avatar'];
                        } ?>" alt="">
            </div>
            <div class="curriculum-info">
              <h3><?= $curriculum['name'] ?> - <span class="curriculum-views"><?= $curriculum['views'] ?> views</span></h3>
              <p><?= $curriculum['description'] ?></p>
            </div>
          </div>
          <div class="curriculum-options">
            <p class="curriculum-user">By: <b><?= $curriculum['user']['username'] ?></b></p>
            <a class="icon" href="/<?= $_ENV["BASE_DIR"] ?>/view?id=<?= $curriculum['id'] ?>">
              <i class="fa-solid fa-eye"></i>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>