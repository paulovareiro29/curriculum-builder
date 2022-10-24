<?php
  /*  Add verification to check if the curriculum 
      belongs to the user that requested           */
  $curriculum = CurriculumController::get($_GET['id']);
  if($curriculum === null) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice")
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
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/edit.css" />
    <title>Paulo Vareiro n24473</title>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://kit.fontawesome.com/be947b2e4a.js" crossorigin="anonymous"></script>
  </head>
  <body>

    <div class="navbar">
      <div class="navbar-wrapper">
        <div>
          <a href="/<?=$_ENV["BASE_DIR"] ?>/backoffice">Manage my curriculums</a>
        </div>
        <div>
          <p>Logged in as <b><?php echo $_SESSION["user"]; ?></b></p>
          <a href="/<?=$_ENV["BASE_DIR"] ?>/logout">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
        </div>
      </div>
    </div>
      
    <div id="badge-edit-success" class="main-container alert alert-success d-none">Curriculum has been saved successfuly!</div>
    <div id="badge-edit-error" class="main-container alert alert-danger d-none">An error occured while trying to save.</div>


    <div class="main-container curriculum">
      <nav id="edit-navigation" class="col">
        <ul>
          <li class="active" data-link="profile"><i class="fa-solid fa-user"></i><p>Profile</p></li>
          <li data-link="skills"><i class="fa-solid fa-star"></i><p>Skills</p></li>
          <li data-link="education"><i class="fa-sharp fa-solid fa-graduation-cap"></i><p>Education</p></li>
          <li data-link="experience"><i class="fa-solid fa-building"></i><p>Experience</p></li>
        </ul>
      </nav>

      <form id="edit-form" data-curriculum="<?=$curriculum['id']?>" class="col" enctype="multipart/form-data">
        <div id="main-content" class="form-row">
          <div id="profile">
            <h1>Profile</h1>
            <div class="profile-header">
              <div>
                <div class="profile-avatar">
                  <label>
                    <figure class="avatar-container">
                      <img id="avatar-img" src="<?=$curriculum['avatar'];?>" alt="">
                      <figcaption>
                        Upload
                      </figcaption>
                    </figure>
                    <input data-field="avatar" id="avatar-input" type="file" accept="image/png, image/jpeg">
                  </label>
                </div>
              </div>
              
            
              <div class="w-100">
                <div class="form-row">
                  <div class="form-group">
                      <label for="person_name">Name</label>
                      <input
                        type="text"
                        name="person_name"
                        id="person_name"
                        placeholder="Name"
                        value="<?=$curriculum['person_name']?>"
                        data-field="person_name"
                        required
                      />
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group">
                      <label for="summary">Summary</label>
                      <textarea
                        type="text"
                        name="summary"
                        id="summary"
                        placeholder="Summary"
                        rows="4"
                        data-field="summary"
                        required
                      ><?=$curriculum['summary']?></textarea>
                  </div>
                </div>
              </div>
              
            </div>
            

          </div>
          <div id="skills"><h1>Skills</h1></div>
          <div id="education"><h1>Education</h1></div>
          <div id="experience"><h1>Experience</h1></div>
        </div>
        <div class="form-row">
          <button type="submit" name="edit-curriculum">SAVE</button>
        </div>
      </form>
    </div>

    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/script.js"></script>
    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/edit.js"></script>
  </body>
</html>
