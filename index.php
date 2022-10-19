<?php
  require_once __DIR__ . '/config.php';

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
        require __DIR__ . '/src/views/404.php'; 
        
        break;
  }