<?php
  require_once 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  $dotenv->required(["BASE_DIR", "SRC_DIR", "DB_NAME", "DB_SERVER", "DB_USERNAME", "ROOT_USERNAME", "ROOT_PASSWORD"])->notEmpty();

  include_once __DIR__ . '/src/controllers/user.controller.php';
  include_once __DIR__ . '/src/controllers/role.controller.php';
  include_once __DIR__ . '/src/controllers/auth.controller.php';
  include_once __DIR__ . '/src/controllers/curriculum.controller.php';
  include_once __DIR__ . '/src/controllers/message.controller.php';
  include_once __DIR__ . '/src/controllers/manager.controller.php';