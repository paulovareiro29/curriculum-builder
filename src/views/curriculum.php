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
    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR']?>/assets/css/curriculum.css" />
    <title>Paulo Vareiro n24473</title>

    <script src="https://kit.fontawesome.com/be947b2e4a.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php if(AuthController::isLoggedIn()): ?>
      <div class="navbar">
        <div class="navbar-wrapper">
          <div>
            <a href="./backoffice">Manage my curriculum</a>
          </div>
          <div>
            <p>Logged in as <b><?php echo $_SESSION["user"]; ?></b></p>
            <a href="./logout">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="profile">
      <div class="profile-header">
        <img
          src="./src/assets/photo.jpg"
          alt="Paulo Vareiro's profile picture"
          class="profile-picture"
        />
        <div class="profile-header-info">
          <h2>Hello, I am</h2>
          <h1>PAULO VAREIRO</h1>
          <h4>SOFTWARE DEVELOPER</h4>
        </div>
      </div>
      <div class="profile-body">
        <!-- LEFT COLUMN -->
        <div class="col">
          <section class="info-section">
            <h2>INFO</h2>
            <div>
              <a href="mailto:paulovareiro29@gmail.com">
                <i class="fa fa-2x fa-envelope"></i>
                paulovareiro29@gmail.com
              </a>
            </div>
            <div>
              <a href="tel:+351919191919">
                <i class="fa fa-2x fa-phone"></i>
                +351 919191919
              </a>
            </div>

            <div>
              <i class="fa fa-2x fa-map-marker"></i>
              Povoa de Varzim, Portugal
            </div>
          </section>

          <section class="skills-section">
            <h2>SKILLS</h2>
            <div>
              <p>Flexible and Adaptable</p>
              <ul>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
              </ul>
            </div>
            <div>
              <p>Self-Motivated</p>
              <ul>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
              </ul>
            </div>
            <div>
              <p>Responsible</p>
              <ul>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
              </ul>
            </div>
            <div>
              <p>Source and Version Control: Git, Github, Azure..</p>
              <ul>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
              </ul>
            </div>
            <div>
              <p>UI / UX</p>
              <ul>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
              </ul>
            </div>
            <div>
              <p>Testing</p>
              <ul>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle"></i></li>
                <li><i class="fa fa-circle-o"></i></li>
              </ul>
            </div>
          </section>

          <section class="education-section">
            <h2>EDUCATION</h2>

            <div class="education">
              <p class="education-date">
                <i class="fa fa-calendar"></i>
                September 2021 - Current date
              </p>
              <h4>Polytechnic Institute of Viana Do Castelo</h4>
              <p>Bachelor's in Software Development</p>
              <p><small>Viana Do Castelo, Portugal</small></p>
            </div>

            <div class="education">
              <p class="education-date">
                <i class="fa fa-calendar"></i>
                September 2019 - June 2021
              </p>
              <h4>Polytechnic Institute of Viana Do Castelo</h4>
              <p>Technical Degree in Software Development</p>
              <p><small>Viana Do Castelo, Portugal</small></p>
            </div>
          </section>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col">
          <section class="profile-section">
            <h2>PROFILE</h2>
            <p>
              Passionate and hard working full-stack developer with a keen eye
              for detail. Has a good grasp of design patterns and software
              architectures. Knowledgeable in user interface, testing and
              debugging processes and able to effectively self-manage during
              independent projects, as well as collaborate as part of a
              productive team. Developed companies websites and
              refactored/maintained existing web and android applications.
            </p>
          </section>

          <section class="experience-section">
            <h2>EXPERIENCE</h2>

            <div class="experience">
              <div class="experience-title">
                <h4>Techmeout.io</h4>
                <p class="experience-date">
                  <i class="fa fa-calendar"></i>
                  February 2022 - Current date
                </p>
              </div>
              <p>React Developer</p>
              <p>
                Techmeout.io is a tech resume builder company located in
                Amsterdam
              </p>
              <ul>
                <li>
                  <p>
                    Implemented new features like word highlighting and resumes
                    live-preview.
                  </p>
                </li>
                <li>
                  <p>
                    Improved efficiency, executable size, and readability of
                    previously poorly maintained code modules through code
                    refactoring and optimization
                  </p>
                </li>
                <li><p>Refactored old website design.</p></li>
              </ul>
            </div>

            <div class="experience">
              <div class="experience-title">
                <h4>Aruki Sushi Delivery</h4>
                <p class="experience-date">
                  <i class="fa fa-calendar"></i>
                  April 2022 - July 2022
                </p>
              </div>
              <p>Android Native Developer</p>
              <p>
                Aruki Sushi Delivery is a sushi delivery company located in
                Lisbon, Portugal.
              </p>
              <ul>
                <li>
                  <p>Debugged and fixed critical bugs reported by customers.</p>
                </li>
                <li><p>Refactored design for better UX.</p></li>
                <li><p>Implemented new features like coupon discounts.</p></li>
              </ul>
            </div>

            <div class="experience">
              <div class="experience-title">
                <h4>Webincode</h4>
                <p class="experience-date">
                  <i class="fa fa-calendar"></i>
                  March 2021 - June 2021
                </p>
              </div>
              <p>Frontend Developer Intern</p>
              <p>
                Webincode is a software development company located in Viana do
                Castelo, Portugal
              </p>
              <ul>
                <li>
                  <p>
                    Developed websites frontend, converting design into pixel
                    perfect websites with HTML, Javascript, JQuery, CSS,
                    Bootstrap.
                  </p>
                </li>
                <li><p>Solved problems on existing applications.</p></li>
                <li>
                  <p>Implemented new features for various applications.</p>
                </li>
                <li>
                  <p>
                    Collaborated with quality engineers, product management,
                    design to ensure quality in all phases of development.
                  </p>
                </li>
              </ul>
            </div>
          </section>
        </div>
      </div>
      <div class="profile-footer">
        <h1>Contact Me!</h1>
        <form action="#" id="contact-form">
          <div class="form-row">
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input
                type="text"
                name="firstName"
                id="firstName"
                placeholder="First Name"
              />
            </div>
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input
                type="text"
                name="lastName"
                id="lastName"
                placeholder="Last Name"
              />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" placeholder="Email" />
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="tel" name="phone" id="phone" placeholder="Phone" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="message">Message</label>
              <textarea
                name="message"
                id="message"
                rows="5"
                placeholder="Message"
              ></textarea>
            </div>
          </div>
          <div class="form-row">
            <button type="submit">SUBMIT</button>
          </div>
        </form>
      </div>
    </div>

    <?php if(!AuthController::isLoggedIn()): ?>
      <a class="floating-button" href="./login">
        <i class="fa fa-user-circle"></i>
      </a>
    <?php endif; ?>

    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/script.js"></script>
    <script src="/<?= $_ENV['SRC_DIR']?>/assets/js/curriculum.js"></script>
  </body>
</html>
