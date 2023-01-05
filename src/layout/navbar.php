<nav class="navbar">
  <div class="navbar-wrapper container">
    <ul>
      <li class="navbar-link"><a href="/<?= $_ENV["BASE_DIR"] ?>/" class="logo">CBuilder</a></li>
      <?php if (AuthController::isLoggedIn()) : ?>
        <li class="navbar-link desktop-link"><a href="/<?= $_ENV["BASE_DIR"] ?>/backoffice">Dashboard</a></li>
      <?php endif; ?>
      <li class="navbar-link desktop-link"><a href="/<?= $_ENV["BASE_DIR"] ?>/showcase">Showcase</a></li>
      <li class="navbar-link desktop-link"><a href="/<?= $_ENV["BASE_DIR"] ?>/salary">Salary</a></li>
      <?php if (AuthController::isAdmin()) : ?>
        <li class="navbar-link hoverable-link desktop-link">
          Admin
          <ul class="hoverable-group">
            <a href="/<?= $_ENV["BASE_DIR"] ?>/users">Users List</a>
          </ul>
        </li>
      <?php endif; ?>
    </ul>
    <ul>
      <li class="navbar-link">
        <div class="darkmode-switch" id="darkmode-switch">
          <i class="fa-solid fa-sun light-icon"></i>
          <i class="fa-solid fa-moon dark-icon"></i>
        </div>
      </li>
      <?php if (AuthController::isLoggedIn()) : ?>
        <p class="text-end desktop-link">Hello, <b><?php echo $_SESSION["user"]; ?></b></p>
        <li class="navbar-link desktop-link">
          <a href="/<?= $_ENV["BASE_DIR"] ?>/logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
          </a>
        </li>
      <?php else : ?>
        <li class="navbar-link desktop-link">
          <a href="/<?= $_ENV["BASE_DIR"] ?>/register">
            Create an account
          </a>
        </li>
        <li class="navbar-link">
          <a href="/<?= $_ENV["BASE_DIR"] ?>/login">
            Sign in
          </a>
        </li>
      <?php endif; ?>
      <li class="navbar-link">
        <i class="fa-solid fa-bars" id="mobile-drawer-btn"></i>
      </li>
    </ul>
  </div>
  <div class="navbar-mobile-drawer" id="mobile-drawer">
    <div class="drawer-background"></div>
    <div class="drawer-content">
      <h2>Navigation</h2>
      <ul>
        <li><a href="/<?= $_ENV["BASE_DIR"] ?>/">Home</a></li>
        <?php if (AuthController::isLoggedIn()) : ?>
          <li><a href="/<?= $_ENV["BASE_DIR"] ?>/backoffice">Dashboard</a></li>
        <?php endif; ?>
        <li><a href="/<?= $_ENV["BASE_DIR"] ?>/showcase">Showcase</a></li>
      </ul>
      <?php if (AuthController::isAdmin()) : ?>
        <h2>Admin</h2>
        <ul>
          <li><a href="/<?= $_ENV["BASE_DIR"] ?>/users">Users</a></li>
        </ul>
      <?php endif; ?>
      <h2>Account</h2>
      <ul>
        <?php if (AuthController::isLoggedIn()) : ?>
          <li><a href="/<?= $_ENV["BASE_DIR"] ?>/logout">Sign out</a></li>
        <?php else : ?>
          <li><a href="/<?= $_ENV["BASE_DIR"] ?>/register">Create an account</a></li>
          <li><a href="/<?= $_ENV["BASE_DIR"] ?>/login">Sign in</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>