<?php

$success = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $name = $_POST["name"];
  $description = $_POST["description"];
  $avatar = null;

  if (isset($_FILES['avatar']) && $_FILES['avatar']['type'] == "image/jpeg" || $_FILES['avatar']['type'] == "image/jpeg") {
    $avatar = base64_encode(file_get_contents($_FILES["avatar"]["tmp_name"]));
    $avatar = "data:{$_FILES['avatar']['type']};base64,{$avatar}";
  }


  if (CurriculumController::create($_SESSION['user'], $name, $description, $avatar)) {
    $success = 1;
  } else {
    $success = 2;
  }
}

$user = UserController::getByUsername($_SESSION['user']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once(__ROOT__ . "/layout/head.php"); ?>

  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/backoffice.css" />
  <title>Curriculum Builder</title>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>

<div class="modal" id="new-curriculum">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      Add new Curriculum
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <form action="#" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" placeholder="Description" rows="4"></textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" id="avatar" placeholder="Avatar" accept="image/png, image/jpeg" />
          </div>
        </div>
        <div class="form-row">
          <button type="submit" name="new-curriculum">SUBMIT</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="delete-curriculum">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      Are you sure?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div class="modal-options">
        <button type="button" class="btn btn-danger" name="delete-curriculum" onclick="closeModal('delete-curriculum')">CANCEL</button>
        <button type="button" class="btn" name="delete-curriculum" id="delete-curriculum-btn">CONFIRM</button>
      </div>
    </div>
  </div>
</div>

<div class="modal guide-modal" id="guide-dashboard">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p>1) Start by creating your curriculum on the <b>[+]</b> button.</p>
        <p>2) Fill the fields with your curriculum name and description.</p>
        <p>3) After the curriculum is successfuly created you can visualize <i class="fa-solid fa-eye"></i>, personalize <i class="fa-solid fa-pen-to-square color-warning"></i> and delete <i class="fa-solid fa-trash color-danger"></i></p>
        <p>4) You can also check all the messages sent to you on a specified curriculum <i class="fa-solid fa-envelope"></i>. If you have unread messages the icon becomes blue <i class="fa-solid fa-envelope color-info"></i></p>
      </div>
      <button type="button" class="btn btn-md" onclick="closeModal('guide-dashboard')">GOT IT</button>
    </div>
  </div>
</div>

<div class="backoffice container">

  <?php if ($success == 1) : ?>
    <div class="new alert alert-success">New curriculum has been created!</div>
  <?php elseif ($success == 2) : ?>
    <div class="new alert alert-danger">An error has occurred.</div>
  <?php endif; ?>


  <div class="delete alert alert-danger d-none">An error has occurred.</div>
  <div class="delete alert alert-success d-none">Curriculum has been deleted successfuly!</div>


  <div class="curriculums">
    <div class="d-flex align-center gap-8 mb-16">
      <h1>My Curriculums</h1>
      <button type="button" onclick="showModal('guide-dashboard')" class="btn btn-circle-md guide-btn">?</button>
      <button type="button" onclick="showModal('new-curriculum')" class="btn btn-primary mb-1 btn-circle-md"><i class="fa-solid  fa-plus"></i></button>
    </div>

    <div class="curriculums-list">
      <?php $list = CurriculumController::indexByUser($_SESSION["user"]); ?>

      <?php if (!$list || sizeof($list) <= 0) : ?>
        <div class="empty-state">
          <img src="/<?= $_ENV['SRC_DIR'] ?>/assets/images/file.svg" alt="">
          <h3>No Curriculums Found.</h3>
          <p>It seems like you have no curriculums, yet! Why don't you try to create one?</p>
        </div>
      <?php endif; ?>

      <?php foreach ($list as $curriculum) : ?>
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
            <a class="icon" href="/<?= $_ENV["BASE_DIR"] ?>/view?id=<?= $curriculum['id'] ?>">
              <i class="fa-solid fa-eye"></i>
            </a>
            <a class="icon <?php if ($curriculum["unread_messages"]) {
                              echo "color-info";
                            } ?>" href="/<?= $_ENV["BASE_DIR"] ?>/backoffice/messages?id=<?= $curriculum['id'] ?>">
              <i class="fa-solid fa-envelope"></i>
            </a>
            <a class="icon color-warning" href="/<?= $_ENV["BASE_DIR"] ?>/backoffice/edit?id=<?= $curriculum['id'] ?>">
              <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a class="icon color-danger show-delete-curriculum" href="#">
              <i class="fa-solid fa-trash"></i>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php if (UserController::hasRole($user['username'], $_ENV['MANAGER_ROLE'])) : ?>
    <div class="curriculums">
      <div class="title">
        <h1>Managing Curriculums</h1>
      </div>

      <div class="curriculums-list">
        <?php $managingList = ManagerController::indexCurriculums($user['id']); ?>

        <?php if (!$managingList || sizeof($managingList) <= 0) : ?>
          <div class="empty-state">
            <img src="/<?= $_ENV['SRC_DIR'] ?>/assets/images/file.svg" alt="">
            <h3>No Curriculums Found.</h3>
            <p>It seems like you have no curriculums, yet! Why don't you try to create one?</p>
          </div>
        <?php endif; ?>

        <?php foreach ($managingList as $curriculum) : ?>
          <div class="curriculum" data-id="<?= $curriculum['id'] ?>">
            <div class="curriculum-body">
              <div class="curriculum-avatar">
                <img src="<?= $curriculum['avatar']; ?>" alt="">
              </div>
              <div class="curriculum-info">
                <h3><?= $curriculum['name'] ?></h3>
                <p><?= $curriculum['description'] ?></p>
              </div>
            </div>
            <div class="curriculum-options">
              <a class="icon" href="/<?= $_ENV["BASE_DIR"] ?>/view?id=<?= $curriculum['id'] ?>">
                <i class="fa-solid fa-eye"></i>
              </a>
              <a class="icon <?php if ($curriculum["unread_messages"]) {
                                echo "color-info";
                              } ?>" href="/<?= $_ENV["BASE_DIR"] ?>/backoffice/messages?id=<?= $curriculum['id'] ?>">
                <i class="fa-solid fa-envelope"></i>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

</div>

<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/backoffice.js"></script>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>