<?php
  require 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  $dotenv->required(["BASE_DIR", "SRC_DIR", "DB_NAME", "DB_SERVER", "DB_USERNAME"])->notEmpty();

  $dir = $_SERVER['REQUEST_URI'];
  $baseUri = str_replace("/curriculum", "", $dir);

  switch ($baseUri) {
    case '/':
      case '':
        require __DIR__ . '/src/views/curriculum.php';
        break;
    case '/login':
        require __DIR__ . '/src/views/login.php';
        break;
    default:
        http_response_code(404);
        /* require __DIR__ . '/src/views/404.php'; */
        require __DIR__ . '/src/services/user.service.php';
        break;
  }