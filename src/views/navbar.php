<div class="navbar">
    <div class="navbar-wrapper">
      <div>
        <a href="/<?=$_ENV["BASE_DIR"] ?>/">Home</a>
        <a href="/<?=$_ENV["BASE_DIR"] ?>/backoffice">Dashboard</a>
      </div>
      <div>
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