<div class="navbar">
    <div class="navbar-wrapper">
      <div>
        <a href="/<?=$_ENV["BASE_DIR"] ?>/">Home</a>
        <a href="/<?=$_ENV["BASE_DIR"] ?>/backoffice">Dashboard</a>
        <?php if(AuthController::isAdmin()):?>
          <a href="/<?=$_ENV["BASE_DIR"] ?>/users">Users</a>
        <?php endif;?>
      </div>
      <div>
      <div>
          <div class="darkmode-switch" id="darkmode-switch">
            <span id="darkmode-span">Lightmode</span>
            <label for="darkmode" class="switch">
              <input type="checkbox" id="darkmode" />
              <div class="slider round"></div>
            </label>
          </div>
        </div>
        <?php if(AuthController::isLoggedIn()):?>
          <p class="text-end">Logged in as <b><?php echo $_SESSION["user"]; ?></b></p>
          <a href="/<?=$_ENV["BASE_DIR"] ?>/logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
          </a>
        <?php else:?>
          <a href="/<?=$_ENV["BASE_DIR"] ?>/login">
            Login
          </a>
        <?php endif;?>
      </div>
    </div>
</div>