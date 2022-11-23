<nav class="navbar">
    <div class="navbar-wrapper container">
      <div>
        <a href="/<?=$_ENV["BASE_DIR"] ?>/" class="logo">CBuilder</a>
          <?php if(AuthController::isLoggedIn()):?>
            <a href="/<?=$_ENV["BASE_DIR"] ?>/backoffice" class="desktop-link">Dashboard</a>
          <?php endif;?>
          <a href="/<?=$_ENV["BASE_DIR"] ?>/public" class="desktop-link">Public Curriculums</a>
          <?php if(AuthController::isAdmin()):?>
            <a href="/<?=$_ENV["BASE_DIR"] ?>/users">Users</a>
          <?php endif;?>
      </div>
      <div>
      <div>
        <div class="darkmode-switch" id="darkmode-switch">
            <i class="fa-solid fa-sun light-icon"></i>
            <i class="fa-solid fa-moon dark-icon"></i>
          </div>
        </div>
        <?php if(AuthController::isLoggedIn()):?>
            <p class="text-end desktop-link">Hello, <b><?php echo $_SESSION["user"]; ?></b></p>
            <a href="/<?=$_ENV["BASE_DIR"] ?>/logout" class="desktop-link">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        <?php else:?>
          <a href="/<?=$_ENV["BASE_DIR"] ?>/register" class="desktop-link">
            Create an account
          </a>
          <a href="/<?=$_ENV["BASE_DIR"] ?>/login">
            Sign in
          </a>
        <?php endif;?>
        <i class="fa-solid fa-bars" id="mobile-drawer-btn"></i>
      </div>
    </div>
    <div class="navbar-mobile-drawer" id="mobile-drawer">
      <div class="drawer-background"></div>
      <div class="drawer-content">
        <h2>Navigation</h2>
        <ul>
          <li><a href="/<?=$_ENV["BASE_DIR"] ?>/">Home</a></li>
          <?php if(AuthController::isLoggedIn()):?>
            <li><a href="/<?=$_ENV["BASE_DIR"] ?>/backoffice">Dashboard</a></li>
          <?php endif;?>
            <li><a href="/<?=$_ENV["BASE_DIR"] ?>/public">Public Curriculums</a></li>
        </ul>
        <h2>Account</h2>
        <ul>
          <?php if(AuthController::isLoggedIn()):?>
            <li><a href="/<?=$_ENV["BASE_DIR"] ?>/logout">Sign out</a></li>
          <?php else:?>
            <li><a href="/<?=$_ENV["BASE_DIR"] ?>/register">Create an account</a></li>
            <li><a href="/<?=$_ENV["BASE_DIR"] ?>/login">Sign in</a></li>
          <?php endif;?>
        </ul>
      </div>
    </div>
</nav>