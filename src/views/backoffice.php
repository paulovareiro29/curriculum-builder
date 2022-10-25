<?php

  $success = 0;
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $avatar = base64_encode(file_get_contents($_FILES["avatar"]["tmp_name"]));
    $avatar = "data:{$_FILES['avatar']['type']};base64,{$avatar}"; 


    if(CurriculumController::create($_SESSION['user'], $name, $description, $avatar)) {
      $success = 1;
    }else{
      $success = 2;
    } 
  }

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
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/backoffice.css" />
    <title>Paulo Vareiro n24473</title>

    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/lib/axios.js"></script>
    <script src="https://kit.fontawesome.com/be947b2e4a.js" crossorigin="anonymous"></script>
  </head>
  <body>
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
                  <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Name"
                    required
                  />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                  <label for="description">Description</label>
                  <textarea
                    type="text"
                    name="description"
                    id="description"
                    placeholder="Description"
                    rows="4"
                    required
                  ></textarea>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                  <label for="avatar">Avatar</label>
                  <input
                    type="file"
                    name="avatar"
                    id="avatar"
                    placeholder="Avatar"
                    required
                  ></textarea>
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
          <a class="btn btn-danger" name="delete-curriculum" onclick="closeModal('delete-curriculum')">CANCEL</a>
          <a class="btn" name="delete-curriculum" id="delete-curriculum-btn">CONFIRM</a>
        </div>
      </div>
    </div>

    <div class="navbar">
      <div class="navbar-wrapper">
        <div>
          <a href="#" onclick="showModal('new-curriculum')">New Curriculum</a>
        </div>
        <div>
          <p>Logged in as <b><?php echo $_SESSION["user"]; ?></b></p>
          <a href="/<?=$_ENV["BASE_DIR"] ?>/logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="backoffice">

      <?php if($success == 1):?>
      <?php elseif($success == 2):?>
      <?php endif; ?>

      <?php if(isset($_GET['deleted']) && $_GET['deleted'] == 1):?>
      <?php elseif(isset($_GET['deleted']) && $_GET['deleted'] == 2):?>
      <?php endif; ?>

      <div class="new alert alert-danger d-none">An error has occurred.</div>
      <div class="new alert alert-success d-none">New curriculum has been created!</div>

      <div class="delete alert alert-danger d-none">An error has occurred.</div>
      <div class="delete alert alert-success d-none">Curriculum has been deleted successfuly!</div>


      <div class="curriculums">
        <h1>My Curriculums</h1>
        <div class="curriculums-list">
          <?php 
            $list = CurriculumController::indexByUser($_SESSION["user"]);

            foreach($list as $curriculum):?>
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
                  <a class="icon" href="/<?=$_ENV["BASE_DIR"] ?>/?id=<?=$curriculum['id']?>">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  <a class="icon" href="/<?=$_ENV["BASE_DIR"] ?>/backoffice/messages/?id=<?=$curriculum['id']?>">
                    <i class="fa-solid fa-envelope"></i>
                  </a>
                  <a class="icon color-warning" href="/<?=$_ENV["BASE_DIR"] ?>/backoffice/edit/?id=<?=$curriculum['id']?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  <a class="icon color-danger" href="#" id="show-delete-curriculum">
                    <i class="fa-solid fa-trash"></i>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
        </div>
      </div>
      
    </div>
    
    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/lib/jquery.js"></script>
    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/script.js"></script>
    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/backoffice.js"></script> 
  </body>
</html>