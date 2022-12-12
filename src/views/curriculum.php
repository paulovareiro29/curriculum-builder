<?php
if (!isset($_GET['id'])) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
$curriculum = CurriculumController::get($_GET['id']);
if ($curriculum === null) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");


CurriculumController::viewed($curriculum['id']);

$templates = ["default", "vibes"];
$selectedTemplate = "default";

if (isset($_GET['template']) && in_array($_GET['template'], $templates)) {
  $selectedTemplate = $_GET['template'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once(__ROOT__ . "/layout/head.php"); ?>

  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/curriculum.css" />
  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/default.template.css" />
  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/vibes.template.css" />
  <title>Curriculum Builder</title>

  <script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/lib/html2canvas.min.js"></script>
  <script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/lib/jspdf.js"></script>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>

<div class="container mb-32">
  <div id="curriculum">
    <?php require_once(__ROOT__ . "/layout/{$selectedTemplate}.template.php") ?>
  </div>

  <div class="curriculum-contact">
    <h1>Contact Me!</h1>
    <form action="#" id="contact-form">
      <div class="alert alert-success d-none">Message sent!</div>
      <div class="alert alert-danger d-none">Error has occurred!</div>
      <input type="hidden" name="curriculum_id" value="<?= $curriculum['id'] ?>">
      <input type="hidden" name="user_id" value="<?= $curriculum['user_id'] ?>">
      <div class="form-row">
        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" name="first_name" id="first_name" placeholder="First Name" required />
        </div>
        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" name="last_name" id="last_name" placeholder="Last Name" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="Email" required />
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="tel" name="phone" id="phone" placeholder="Phone" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" name="subject" id="subject" placeholder="Subject" required />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="message">Message</label>
          <textarea name="message" id="message" rows="5" placeholder="Message" required></textarea>
        </div>
      </div>
      <div class="form-row">
        <button type="submit">SUBMIT</button>
      </div>
    </form>
  </div>
</div>


<button class="floating-button floating-button-left" id="download">
  <i class="fa-solid fa-download"></i>
</button>

<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/curriculum.js"></script>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>