<?php

  $success = 0;
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST["name"];
    $person_name = $_POST["person_name"];

    if(CurriculumController::create($name, $person_name)) {
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
    <link rel="stylesheet" href="./src/assets/css/style.css" />
    <link rel="stylesheet" href="./src/assets/css/backoffice.css" />
    <title>Paulo Vareiro n24473</title>

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
          <form action="#" method="POST">
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
                  <label for="person_name">Person Name</label>
                  <input
                    type="text"
                    name="person_name"
                    id="person_name"
                    placeholder="Person Name"
                    required
                  />
              </div>
            </div>
            <div class="form-row">
              <button type="submit" name="new-curriculum">SUBMIT</button>
            </div>
          </form>
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
          <a href="./logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="backoffice">

      <?php if($success == 1):?>
        <div class="alert alert-success">New curriculum has been created!</div>
      <?php elseif($success == 2):?>
        <div class="alert alert-danger">An error has occurred.</div>
      <?php endif; ?>

    </div>
    <a class="floating-button floating-button-left" href="./">
      <i class="fa fa-arrow-left"></i>  
    </a>
    <script src="./src/assets/js/script.js"></script>
    <script src="./src/assets/js/backoffice.js"></script>
  </body>
</html>