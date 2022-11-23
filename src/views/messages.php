<?php 
    if(!isset($_GET['id'])) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
    $curriculum = CurriculumController::get($_GET['id']);
    if($curriculum === null) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");

    $messages = MessageController::indexByCurriculum($_GET['id'])
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("head.php"); ?>
    
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/messages.css" />
    <title>Curriculum Builder</title>
<<<<<<< HEAD
=======

    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/lib/axios.js"></script>
    <script src="https://kit.fontawesome.com/be947b2e4a.js" crossorigin="anonymous"></script>
>>>>>>> 6d682f38dd80cd29aa3f11959261301615582561
  </head>
  <body>
    
    <?php require_once("navbar.php")?>

    <div class="main-container messages container">
        <h1>Messages</h1>
        <h4><?=$curriculum['name']?></h4>

        <div class="messages-list">
          <?php if(!$messages || sizeof($messages) <= 0):?>
            <div class="empty-state">
              <img src="/<?=$_ENV['SRC_DIR']?>/assets/images/envelope.svg" alt="">
              <h3>No Messages Found.</h3>
              <p>No one has contacted you yet on this curriculum.</p>
            </div>
          <?php endif;?>

          <?php foreach($messages as $item):?>
              <div class="message <?php if($item["viewed"] == 1){ echo "message-viewed"; }?>" data-id="<?= $item['id']?>">
                <div class="message-header">
                  <div class="message-title-wrapper"><h3 class="message-title"><?=$item['subject']?></h3> <h3 class="message-date"><?=$item['created_at']?></h3></div>
                  <div class="message-options">
                    <h6 class="message-read">Mark As Read</h6>
                    <h6 class="message-unread">Mark As Unread</h6>
                  </div>
                </div>
                <h5 class="message-sender">By: <b><?="{$item['first_name']} {$item['last_name']}"?></b></h5>
                <h6><?=$item['email']?></h6>
                <h6><?=$item['phone']?></h6>
                <div class="message-body">
                  <p><?=$item['message']?></p>
                </div>
              </div>
          <?php endforeach;?>
        </div>
    </div>
<<<<<<< HEAD
=======

    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/lib/jquery.js"></script>
    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/script.js"></script>
    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/messages.js"></script>
>>>>>>> 6d682f38dd80cd29aa3f11959261301615582561
  </body>
</html>