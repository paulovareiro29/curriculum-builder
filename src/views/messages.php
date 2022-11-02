<?php 
    if(!isset($_GET['id'])) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
    $curriculum = CurriculumController::get($_GET['id']);
    if($curriculum === null) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");

    $messages = MessageController::indexByCurriculum($_GET['id'])
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
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/messages.css" />
    <title>Curriculum Builder</title>

    <script src="https://kit.fontawesome.com/be947b2e4a.js" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <?php require_once("navbar.php")?>

    <div class="main-container messages">
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
              <div class="message">
                <h3 class="message-title"><?=$item['subject']?> <small><?=$item['created_at']?></small></h3>
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

    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/lib/jquery.js"></script>
    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/script.js"></script>
  </body>
</html>