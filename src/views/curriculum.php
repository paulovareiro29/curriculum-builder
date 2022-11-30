<?php
if (!isset($_GET['id'])) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
$curriculum = CurriculumController::get($_GET['id']);
if ($curriculum === null) AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once(__ROOT__ . "/layout/head.php"); ?>

  <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/curriculum.css" />
  <title>Curriculum Builder</title>

  <script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/lib/html2canvas.min.js"></script>
  <script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/lib/jspdf.js"></script>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>

<div class="container">
  <div class="profile">
    <div id="curriculum">
      <div class="profile-header">
        <?php if (!empty($curriculum['avatar'])) : ?>
          <div class="profile-picture">
            <img src=<?= $curriculum['avatar'] ?> alt="<?= $curriculum['person_name'] ?>'s avatar" />
          </div>
        <?php endif; ?>

        <?php if (!empty($curriculum['person_name']) || !empty($curriculum['role'])) : ?>
          <div class="profile-header-info">
            <?php if (!empty($curriculum['person_name'])) : ?>
              <h2>Hello, I am</h2>
            <?php endif; ?>
            <h1><?= $curriculum['person_name'] ?></h1>
            <h4><?= $curriculum['role'] ?></h4>
          </div>
        <?php endif; ?>
      </div>
      <div class="profile-body">
        <!-- LEFT COLUMN -->
        <div class="col">
          <?php if (count($curriculum['info']) > 0) : ?>
            <section class="info-section">
              <h2><?= $curriculum['info_header'] ?></h2>

              <?php foreach ($curriculum['info'] as $item) : ?>
                <div>
                  <?php if (empty($item['href'])) : ?>
                    <i class="fa fa-2x fa-<?= $item['icon'] ?>"></i>
                    <?= $item['content'] ?>
                  <?php else : ?>
                    <a href="<?= $item['href'] ?>">
                      <i class="fa fa-2x fa-<?= $item['icon'] ?>"></i>
                      <?= $item['content'] ?>
                    </a>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </section>
          <?php endif; ?>

          <?php if (count($curriculum['skills']) > 0) : ?>
            <section class="skills-section">
              <h2><?= $curriculum['skills_header'] ?></h2>

              <?php foreach ($curriculum['skills'] as $item) : ?>
                <div>
                  <p><?= $item['content'] ?></p>
                  <ul>
                    <?php for ($x = 0; $x < $item['rating']; $x++) : ?>
                      <li><i class="fa fa-circle"></i></li>
                    <?php endfor; ?>

                    <?php for ($x = 0; $x < 5 - $item['rating']; $x++) : ?>
                      <li><i class="fa-regular fa-circle"></i></li>
                    <?php endfor; ?>
                  </ul>
                </div>
              <?php endforeach; ?>
            </section>
          <?php endif; ?>

          <?php if (count($curriculum['education']) > 0) : ?>
            <section class="education-section">
              <h2><?= $curriculum['education_header'] ?></h2>

              <?php foreach ($curriculum['education'] as $item) : ?>
                <div class="education">
                  <p class="education-date">
                    <i class="fa fa-calendar"></i>
                    <?= $item['start_date'] ?> - <?= $item['end_date'] ?>
                  </p>
                  <h4><?= $item['school'] ?></h4>
                  <p><?= $item['course'] ?></p>
                  <p><small><?= $item['location'] ?></small></p>
                </div>
              <?php endforeach; ?>
            </section>
          <?php endif; ?>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col">
          <?php if (!empty($curriculum['summary'])) : ?>
            <section class="profile-section">
              <h2><?= $curriculum['profile_header'] ?></h2>
              <p>
                <?= $curriculum['summary'] ?>
              </p>
            </section>
          <?php endif; ?>

          <?php if (count($curriculum['experience']) > 0) : ?>
            <section class="experience-section">
              <h2><?= $curriculum['experience_header'] ?></h2>

              <?php foreach ($curriculum['experience'] as $item) : ?>
                <div class="experience">
                  <div class="experience-title">
                    <h4><?= $item['company'] ?></h4>
                    <p class="experience-date">
                      <i class="fa fa-calendar"></i>
                      <?= $item['start_date'] ?> - <?= $item['end_date'] ?>
                    </p>
                  </div>
                  <p><?= $item['role'] ?></p>
                  <div><?= $item['summary'] ?></div>
                </div>
              <?php endforeach; ?>

            </section>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="profile-footer">
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
</div>


<button class="floating-button floating-button-left" id="download">
  <i class="fa-solid fa-download"></i>
</button>

<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/curriculum.js"></script>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>