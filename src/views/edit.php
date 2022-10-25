<?php
  /*  Add verification to check if the curriculum 
      belongs to the user that requested           */
  $curriculum = CurriculumController::get($_GET['id']);
  if($curriculum === null) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
  
  $info = $curriculum['info'];
  $skills = $curriculum['skills'];
  $education = $curriculum['education'];
  $experience = $curriculum['experience'];
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

    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/lib/axios.js"></script>
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
          <li class="active" data-link="general"><i class="fa-solid fa-house"></i><p>General</p></li>
          <li data-link="profile"><i class="fa-solid fa-user"></i><p>Profile</p></li>
          <li data-link="info"><i class="fa-solid fa-circle-info"></i><p>Info</p></li>
          <li data-link="skills"><i class="fa-solid fa-star"></i><p>Skills</p></li>
          <li data-link="education"><i class="fa-sharp fa-solid fa-graduation-cap"></i><p>Education</p></li>
          <li data-link="experience"><i class="fa-solid fa-building"></i><p>Experience</p></li>
        </ul>
      </nav>

      <form id="edit-form" data-curriculum="<?=$curriculum['id']?>" class="col" enctype="multipart/form-data">
        <div id="main-content" class="form-row">
          <div id="general">
            <h1>General</h1>
            <div class="form-row">
              <div class="form-group">
                <label for="name">Name</label>
                <input
                  type="text"
                  name="name"
                  id="name"
                  placeholder="Name"
                  value="<?=$curriculum['name']?>"
                  data-field="name"
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
                  data-field="description"
                  required
                ><?=$curriculum['description']?></textarea>
              </div>
            </div>
          </div>

          <div id="profile">

            <input 
              type="text"
              name="profile_header"
              class="editable-header" 
              data-field="profile_header"
              value="<?=$curriculum['profile_header']?>"/>

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
                        data-field="summary"><?=$curriculum['summary']?></textarea>
                  </div>
                </div>
              </div>
              
            </div>
            

          </div>

          <div id="info">
            <input 
              type="text"
              name="info_header"
              class="editable-header" 
              data-field="info_header"
              value="<?=$curriculum['info_header']?>"/>

            <button class="btn btn-primary" type="button" id="add-info">Add new</button>

            <div id="info-list" class="items-list multiple-row">
              <?php foreach($info as $item):?>
                  <div class="item form-row" data-id="<?= $item['id']?>">
                    <div class="form-group">
                      <label>Content</label>
                      <input
                        type="text"
                        data-content
                        placeholder="Content"
                        value="<?=$item['content']?>"
                      />
                    </div>
                    <div class="form-group">
                      <label>Href</label>
                      <input
                        data-href
                        placeholder="Href"
                        value="<?=$item['href']?>"
                      />
                    </div>
                    <div class="form-group">
                      <label>Icon</label>
                      <input
                        data-icon
                        placeholder="Icon"
                        value="<?=$item['icon']?>"
                      />
                    </div>
                    <button class="btn btn-danger" type="button">X</button>
                  </div>
                
              <?php endforeach;?>
            </div>

          </div>

          <div id="skills">
            <input 
              type="text"
              name="skills_header"
              class="editable-header" 
              data-field="skills_header"
              value="<?=$curriculum['skills_header']?>"/>

            <button class="btn btn-primary" type="button" id="add-skill">Add new</button>

            <div id="skills-list" class="items-list multiple-row">
              <?php foreach($skills as $item):?>
                  <div class="item form-row" data-id="<?= $item['id']?>">
                    <div class="form-group">
                      <label>Content</label>
                      <input
                        type="text"
                        data-content
                        placeholder="Content"
                        value="<?=$item['content']?>"
                      />
                    </div>
                    <div class="form-group">
                      <label>Rating</label>
                      <input
                        type="number"
                        data-rating
                        placeholder="Rating"
                        min="0"
                        max="5"
                        value="<?=$item['rating']?>"
                      />
                    </div>
                    <button class="btn btn-danger" type="button">X</button>

                  </div>
                
              <?php endforeach;?>
            </div>
          </div>

          <div id="education">
            <input 
              type="text"
              name="education_header"
              class="editable-header" 
              data-field="education_header"
              value="<?=$curriculum['education_header']?>"/>

              <button class="btn btn-primary" type="button" id="add-education">Add new</button>

              <div id="education-list" class="items-list multiple-row">
              <?php foreach($education as $item):?>
                <div class="item"  data-id="<?= $item['id']?>">
                  <div class="form-row">
                    <div class="form-group">
                      <label>Start Date</label>
                      <input
                        type="text"
                        data-start_date
                        placeholder="Start Date"
                        value="<?=$item['start_date']?>"
                      />
                    </div>
                    <div class="form-group">
                      <label>End Date</label>
                      <input
                        type="text"
                        data-end_date
                        placeholder="End Date"
                        value="<?=$item['end_date']?>"
                      />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group">
                      <label>School</label>
                      <input
                        type="text"
                        data-school
                        placeholder="School"
                        value="<?=$item['school']?>"
                      />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group">
                      <label>Course</label>
                      <input
                        type="text"
                        data-course
                        placeholder="Course"
                        value="<?=$item['course']?>"
                      />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group">
                      <label>Location</label>
                      <input
                        type="text"
                        data-location
                        placeholder="Location"
                        value="<?=$item['location']?>"
                      />
                    </div>
                  </div>
                  <button class="btn btn-danger" type="button">x</button>
                </div>
              <?php endforeach;?>
            </div>
          </div>

          <div id="experience">
            <input 
                type="text"
                name="experience_header"
                class="editable-header" 
                data-field="experience_header"
                value="<?=$curriculum['experience_header']?>"/>

            <button class="btn btn-primary" type="button" id="add-experience">Add new</button>

            <div id="experience-list" class="items-list multiple-row">
              <?php foreach($experience as $item):?>
                <div class="item"  data-id="<?= $item['id']?>">
                  <div class="form-row">
                    <div class="form-group">
                      <label>Start Date</label>
                      <input
                        type="text"
                        data-start_date
                        placeholder="Start Date"
                        value="<?=$item['start_date']?>"
                      />
                    </div>
                    <div class="form-group">
                      <label>End Date</label>
                      <input
                        type="text"
                        data-end_date
                        placeholder="End Date"
                        value="<?=$item['end_date']?>"
                      />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group">
                      <label>Company</label>
                      <input
                        type="text"
                        data-company
                        placeholder="Company"
                        value="<?=$item['company']?>"
                      />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group">
                      <label>Role</label>
                      <input
                        type="text"
                        data-role
                        placeholder="Role"
                        value="<?=$item['role']?>"
                      />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group">
                      <label>Summary</label>
                      <textarea
                        data-summary
                        rows="4"
                        placeholder="Summary"
                      ><?=$item['summary']?></textarea>                      
                    </div>
                  </div>
                  <button class="btn btn-danger" type="button">x</button>
                </div>
              <?php endforeach;?>
            </div>
          </div>
        </div>
        <div class="form-row">
          <button type="submit" name="edit-curriculum">SAVE</button>
        </div>
      </form>
    </div>

    <a class="floating-button floating-button-left" href="/<?= $_ENV['BASE_DIR']?>/backoffice">
      <i class="fa fa-arrow-left"></i>  
    </a>

    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/lib/jquery.js"></script>
    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/script.js"></script>
    <script src="/<?=$_ENV['SRC_DIR']?>/assets/js/edit.js"></script>
  </body>
</html>
