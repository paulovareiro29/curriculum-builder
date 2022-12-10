<?php

# Check if is logged in
if (!isset($_SESSION["user"])) {
  AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/");
  return;
}

$user = UserController::getByUsername($_SESSION["user"]);

if (!isset($_GET['id'])) {
  AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
  return;
}

$curriculum = CurriculumController::get($_GET['id']);
if ($curriculum === null) {
  AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
  return;
}

# Can only access if user is the owner or an allowed manager or admin
if ($curriculum['user_id'] !== $user['id'] && !CurriculumController::isManager($curriculum['id'], $_GET['id']) && !UserController::isAdmin($user['username'])) {
  AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
  return;
}

$messages = MessageController::indexByCurriculum($_GET['id'])
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once(__ROOT__ . "/layout/head.php"); ?>

  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/messages.css" />
  <title>Curriculum Builder</title>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>

<div class="modal guide-modal" id="guide-messages">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p>Here is where you can see all the messages sent to you on a specific curriculum.</p>
        <p>1) Unread messages appear <span class="color-info"><strong>blue.</strong></span></p>
        <p>2) You can mark as <strong>read</strong> / <strong>unread</strong> on message top right corner.</p>
        <p>3) Sender information can be seen on message header, while message itself is on the message footer.</p>
      </div>
      <button class="btn btn-md" onclick="closeModal('guide-messages')">GOT IT</button>
    </div>
  </div>
</div>

<div class="main-container messages container">
  <div class="d-flex align-center gap-8">
    <h1>Messages</h1>
    <button onclick="showModal('guide-messages')" class="btn btn-circle-md guide-btn">?</button>
  </div>

  <h4><?= $curriculum['name'] ?></h4>

  <div class="messages-list">
    <?php if (!$messages || sizeof($messages) <= 0) : ?>
      <div class="empty-state">
        <img src="/<?= $_ENV['SRC_DIR'] ?>/assets/images/envelope.svg" alt="">
        <h3>No Messages Found.</h3>
        <p>No one has contacted you yet on this curriculum.</p>
      </div>
    <?php endif; ?>

    <?php foreach ($messages as $item) : ?>
      <div class="message <?php if ($item["viewed"] == 1) {
                            echo "message-viewed";
                          } ?>" data-id="<?= $item['id'] ?>">
        <div class="message-header">
          <div class="message-title-wrapper">
            <h3 class="message-title"><?= $item['subject'] ?></h3>
            <h3 class="message-date"><?= $item['created_at'] ?></h3>
          </div>
          <div class="message-options">
            <h6 class="message-read">Mark As Read</h6>
            <h6 class="message-unread">Mark As Unread</h6>
          </div>
        </div>
        <h5 class="message-sender">By: <b><?= "{$item['first_name']} {$item['last_name']}" ?></b></h5>
        <h6><?= $item['email'] ?></h6>
        <h6><?= $item['phone'] ?></h6>
        <div class="message-body">
          <p><?= $item['message'] ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/messages.js"></script>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>