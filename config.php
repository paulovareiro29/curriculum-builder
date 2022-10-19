<?php
  require_once 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  $dotenv->required(["BASE_DIR", "SRC_DIR", "DB_NAME", "DB_SERVER", "DB_USERNAME"])->notEmpty();

  include_once __DIR__ . '/src/controllers/user.controller.php';