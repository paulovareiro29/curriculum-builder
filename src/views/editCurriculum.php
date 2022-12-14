<?php
$user = UserController::getByUsername($_SESSION["user"]);
$curriculum = CurriculumController::get($_GET['id']);

if ($curriculum === null || $user === null) {
  AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
  return;
}

if ($user['id'] !== $curriculum['user_id'] && !AuthController::isAdmin()) {
  AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
  return;
}

$icons = ["envelope",  "phone", "location-dot", "linkedin", "globe", "twitter", "instagram", "facebook", "baby", "cake-candles"];
$availableManagers = ManagerController::index();

$info = $curriculum['info'];
$skills = $curriculum['skills'];
$education = $curriculum['education'];
$experience = $curriculum['experience'];
$managers = [];
foreach ($curriculum['managers'] as $manager) {
  foreach ($availableManagers as $available) {
    if ($manager['id'] == $available['id']) {
      array_push($managers, $manager);
      break;
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once(__ROOT__ . "/layout/head.php"); ?>
  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/edit.css" />

  <title>Curriculum Builder</title>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>

<div class="modal guide-modal" id="guide-general">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p><i class="fa-solid fa-house"></i> <strong>General</strong> is the information about your curriculum.</p>
        <p>1) You can change the curriculums <strong>name</strong> and <strong>description</strong> that is shown.</p>
        <p>2) You can also change if the you want to <strong>showcase</strong> your curriculum or not.</p>
      </div>
      <button type="button" class="btn btn-md" onclick="closeModal('guide-general')">GOT IT</button>
    </div>
  </div>
</div>

<div class="modal guide-modal" id="guide-profile">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p><i class="fa-solid fa-user"></i> <strong>Profile</strong> is the information about you!</p>
        <p>1) You can change your <strong>picture</strong>, <strong>name</strong>, <strong>role</strong> and <strong>summary</strong></p>
        <p>2) Click on <strong>Profile</strong> header to edit it!</p>
      </div>
      <button type="button" class="btn btn-md" onclick="closeModal('guide-profile')">GOT IT</button>
    </div>
  </div>
</div>

<div class="modal guide-modal" id="guide-info">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p><i class="fa-solid fa-circle-info"></i> <strong>Info</strong> is where you place your links and social media pages!</p>
        <p>1) Change the <strong>content</strong>, <strong>href</strong> and <strong>icon</strong> of each information. </p>
        <p>2) Href will be placed directly on the link. Use it like the <strong>HTML</strong> attribute. It can also be empty.</p>
        <p>3) Click on <strong>Info</strong> header to edit it!</p>
      </div>
      <button type="button" class="btn btn-md" onclick="closeModal('guide-info')">GOT IT</button>
    </div>
  </div>
</div>

<div class="modal guide-modal" id="guide-skills">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p><i class="fa-solid fa-star"></i> <strong>Skills</strong> is where you showcase all of your most important skills and its rating.</p>
        <p>1) Change the <strong>content</strong> and <strong>rating</strong></p>
        <p>2) <strong>Rating</strong> is a range from 1 to 5</p>
        <p>3) Click on <strong>Skills</strong> header to edit it!</p>
      </div>
      <button type="button" class="btn btn-md" onclick="closeModal('guide-skills')">GOT IT</button>
    </div>
  </div>
</div>

<div class="modal guide-modal" id="guide-education">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p><i class="fa-sharp fa-solid fa-graduation-cap"></i> <strong>Education</strong> is where you show where you have studied.</p>
        <p>1) Change the <strong>start</strong> and <strong>end</strong> date, <strong>school name</strong>, <strong>course</strong> and <strong>school location</strong></p>
        <p>2) Click on <strong>Education</strong> header to edit it!</p>
      </div>
      <button type="button" class="btn btn-md" onclick="closeModal('guide-education')">GOT IT</button>
    </div>
  </div>
</div>

<div class="modal guide-modal" id="guide-experience">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p><i class="fa-solid fa-building"></i> <strong>Experience</strong> is where you show all of your previous experience.</p>
        <p>1) Change the <strong>start</strong> and <strong>end</strong> date, <strong>company name</strong>, <strong>role</strong> and <strong>summary</strong></p>
        <p>2) <strong>Summary</strong> can be HTML tags!</p>
        <p>3) Click on <strong>Experience</strong> header to edit it!</p>
      </div>
      <button type="button" class="btn btn-md" onclick="closeModal('guide-experience')">GOT IT</button>
    </div>
  </div>
</div>

<div class="modal guide-modal" id="guide-managers">
  <div class="modal-background"></div>
  <div class="modal-wrapper">
    <h4 class="modal-title">
      How does it work?
      <i class="fa-solid fa-xmark modal-close"></i>
    </h4>
    <div class="modal-body">
      <div>
        <p><i class="fa-solid fa-user-group"></i> <strong>Managers</strong> is where you control your curriculum managers.</p>
        <p>Each manager has <strong>access</strong> to the messages of the curriculums that they manage. They can mark each message and <strong>read</strong> / <strong>unread</strong></p>
      </div>
      <button type="button" class="btn btn-md" onclick="closeModal('guide-managers')">GOT IT</button>
    </div>
  </div>
</div>

<div class="container">
  <div id="badge-edit-success" class="alert alert-success d-none">Curriculum has been saved successfuly!</div>
  <div id="badge-edit-error" class="alert alert-danger d-none">An error occured while trying to save.</div>
</div>


<div class="edit-container container">
  <nav id="edit-navigation" class="col">
    <ul>
      <li class="active" data-link="general"><i class="fa-solid fa-house"></i>
        <p>General</p>
      </li>
      <li data-link="profile"><i class="fa-solid fa-user"></i>
        <p>Profile</p>
      </li>
      <li data-link="info"><i class="fa-solid fa-circle-info"></i>
        <p>Info</p>
      </li>
      <li data-link="skills"><i class="fa-solid fa-star"></i>
        <p>Skills</p>
      </li>
      <li data-link="education"><i class="fa-sharp fa-solid fa-graduation-cap"></i>
        <p>Education</p>
      </li>
      <li data-link="experience"><i class="fa-solid fa-building"></i>
        <p>Experience</p>
      </li>
      <li data-link="managers"><i class="fa-solid fa-user-group"></i>
        <p>Managers</p>
      </li>
    </ul>
  </nav>

  <form id="edit-form" data-curriculum="<?= $curriculum['id'] ?>" class="col" enctype="multipart/form-data">
    <div id="main-content" class="form-row">
      <div id="general">
        <div class="header">
          <h1>General</h1>
          <button type="button" onclick="showModal('guide-general')" class="btn btn-circle-md guide-btn">?</button>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" value="<?= $curriculum['name'] ?>" data-field="name" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" placeholder="Description" rows="4" data-field="description"><?= $curriculum['description'] ?></textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-checkbox">
            <input type="checkbox" name="is_public" id="is_public" data-field="is_public" <?php if ($curriculum['is_public'] == 1) : ?> checked <?php endif; ?> />
            <label for="is_public">Showcase Curriculum</label>
          </div>
        </div>
      </div>

      <div id="profile">
        <div class="header">
          <input type="text" name="profile_header" class="editable-header" data-field="profile_header" value="<?= $curriculum['profile_header'] ?>" />
          <button type="button" onclick="showModal('guide-profile')" class="btn btn-circle-md guide-btn">?</button>
        </div>

        <div class="profile-header">
          <div>
            <div class="profile-avatar">
              <label>
                <figure class="avatar-container">
                  <img id="avatar-img" src="<?php if (empty($curriculum['avatar'])) {
                                              echo "/{$_ENV["SRC_DIR"]}/assets/images/avatar.png";
                                            } else {
                                              echo $curriculum['avatar'];
                                            } ?>" alt="">
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
                <input type="text" name="person_name" id="person_name" placeholder="Name" value="<?= $curriculum['person_name'] ?>" data-field="person_name" />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="role">Role</label>
                <input type="text" name="role" id="role" placeholder="Name" value="<?= $curriculum['role'] ?>" data-field="role" />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="summary">Summary</label>
                <textarea type="text" name="summary" id="summary" placeholder="Summary" rows="4" data-field="summary"><?= $curriculum['summary'] ?></textarea>
              </div>
            </div>
          </div>

        </div>


      </div>

      <div id="info">
        <div class="header">
          <input type="text" name="info_header" class="editable-header" data-field="info_header" value="<?= $curriculum['info_header'] ?>" />
          <button type="button" onclick="showModal('guide-info')" class="btn btn-circle-md guide-btn">?</button>
        </div>

        <button class="btn btn-primary" type="button" id="add-info">Add new</button>

        <div id="info-list" class="items-list multiple-row">
          <?php foreach ($info as $item) : ?>
            <div class="item form-row" data-id="<?= $item['id'] ?>">
              <div class="form-group">
                <label>Content</label>
                <input type="text" data-content placeholder="Content" value="<?= $item['content'] ?>" />
              </div>
              <div class="form-group">
                <label>Href</label>
                <input data-href placeholder="Href" value="<?= $item['href'] ?>" />
              </div>
              <div class="form-group select-icon">
                <i class="icon fa fa-<?= $item['icon'] ?>"></i>
                <label>Icon</label>
                <select data-icon value="<?= $item['icon'] ?>">
                  <?php foreach ($icons as $icon) : ?>
                    <option value="<?= $icon ?>" <?php if ($item['icon'] == $icon) : ?> selected <?php endif; ?>><?= ucfirst(str_replace("-", " ", $icon)) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button class="btn btn-danger" type="button">X</button>
            </div>

          <?php endforeach; ?>
        </div>

      </div>

      <div id="skills">
        <div class="header">
          <input type="text" name="skills_header" class="editable-header" data-field="skills_header" value="<?= $curriculum['skills_header'] ?>" />
          <button type="button" onclick="showModal('guide-skills')" class="btn btn-circle-md guide-btn">?</button>
        </div>

        <button class="btn btn-primary" type="button" id="add-skill">Add new</button>

        <div id="skills-list" class="items-list multiple-row">
          <?php foreach ($skills as $item) : ?>
            <div class="item form-row" data-id="<?= $item['id'] ?>">
              <div class="form-group">
                <label>Content</label>
                <input type="text" data-content placeholder="Content" value="<?= $item['content'] ?>" />
              </div>
              <div class="form-group">
                <label>Rating</label>
                <input type="number" data-rating placeholder="Rating" min="0" max="5" value="<?= $item['rating'] ?>" />
              </div>
              <button class="btn btn-danger" type="button">X</button>

            </div>

          <?php endforeach; ?>
        </div>
      </div>

      <div id="education">
        <div class="header">
          <input type="text" name="education_header" class="editable-header" data-field="education_header" value="<?= $curriculum['education_header'] ?>" />
          <button type="button" onclick="showModal('guide-education')" class="btn btn-circle-md guide-btn">?</button>
        </div>

        <button class="btn btn-primary" type="button" id="add-education">Add new</button>

        <div id="education-list" class="items-list multiple-row">
          <?php foreach ($education as $item) : ?>
            <div class="item" data-id="<?= $item['id'] ?>">
              <div class="form-row">
                <div class="form-group">
                  <label>Start Date</label>
                  <input type="text" data-start_date placeholder="Start Date" value="<?= $item['start_date'] ?>" />
                </div>
                <div class="form-group">
                  <label>End Date</label>
                  <input type="text" data-end_date placeholder="End Date" value="<?= $item['end_date'] ?>" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>School</label>
                  <input type="text" data-school placeholder="School" value="<?= $item['school'] ?>" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Course</label>
                  <input type="text" data-course placeholder="Course" value="<?= $item['course'] ?>" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Location</label>
                  <input type="text" data-location placeholder="Location" value="<?= $item['location'] ?>" />
                </div>
              </div>
              <button class="btn btn-danger" type="button">X</button>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div id="experience">
        <div class="header">
          <input type="text" name="experience_header" class="editable-header" data-field="experience_header" value="<?= $curriculum['experience_header'] ?>" />
          <button type="button" onclick="showModal('guide-experience')" class="btn btn-circle-md guide-btn">?</button>
        </div>

        <button class="btn btn-primary" type="button" id="add-experience">Add new</button>

        <div id="experience-list" class="items-list multiple-row">
          <?php foreach ($experience as $item) : ?>
            <div class="item" data-id="<?= $item['id'] ?>">
              <div class="form-row">
                <div class="form-group">
                  <label>Start Date</label>
                  <input type="text" data-start_date placeholder="Start Date" value="<?= $item['start_date'] ?>" />
                </div>
                <div class="form-group">
                  <label>End Date</label>
                  <input type="text" data-end_date placeholder="End Date" value="<?= $item['end_date'] ?>" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Company</label>
                  <input type="text" data-company placeholder="Company" value="<?= $item['company'] ?>" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Role</label>
                  <input type="text" data-role placeholder="Role" value="<?= $item['role'] ?>" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Summary</label>
                  <textarea data-summary rows="4" placeholder="Summary"><?= $item['summary'] ?></textarea>
                </div>
              </div>
              <button class="btn btn-danger" type="button">X</button>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div id="managers">
        <div class="header">
          <h1>Managers</h1>
          <button type="button" onclick="showModal('guide-managers')" class="btn btn-circle-md guide-btn">?</button>
        </div>

        <button class="btn btn-primary" type="button" id="add-manager">Add new</button>

        <div id="managers-list" class="items-list multiple-row">
          <?php foreach ($managers as $item) : ?>
            <div class="item form-row" data-id="<?= $item['id'] ?>">
              <div class="form-group">
                <label>Manager</label>
                <select data-manager value="<?= $item['id'] ?>">
                  <?php foreach ($availableManagers as $manager) : ?>
                    <option value="<?= $manager['id'] ?>" <?php if ($manager['username'] == $item['username']) : ?> selected <?php endif; ?>><?= $manager["username"] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button class="btn btn-danger" type="button">X</button>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class="form-row">
      <button type="submit" name="edit-curriculum">SAVE</button>
    </div>
  </form>
</div>

<?php echo "<script>const availableManagers = [";
foreach ($availableManagers as $manager) {
  echo "{id: {$manager['id']}, username: '{$manager['username']}'},";
}
echo "]</script>"; ?>
<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/editPage.js"></script>
<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/editCurriculum.js"></script>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>