<?php
  require_once __DIR__ . '/config.php';

  if (!UserController::validate($_ENV['ROOT_USERNAME'], $_ENV['ROOT_PASSWORD'])){
    UserController::create($_ENV['ROOT_USERNAME'], $_ENV['ROOT_PASSWORD']);
  }

  if(!UserController::hasRole($_ENV['ROOT_USERNAME'], $_ENV['ADMIN_ROLE'])) {
    if(!RoleController::exists($_ENV['ADMIN_ROLE'])) RoleController::create($_ENV['ADMIN_ROLE'], "Administrator Role");
    UserController::addRole($_ENV['ROOT_USERNAME'], $_ENV['ADMIN_ROLE']);
  }

  session_start();

  $dir = $_SERVER['REQUEST_URI'];
  $baseUri = substr_replace($dir, "", strpos($dir, "/curriculum"), strlen("/curriculum"));
  
  if(strpos($baseUri, "?")){
    $baseUri = substr($baseUri,0, strpos($baseUri, "?"));
  }

  switch ($baseUri) {
    case '/':
      case '':
        require __DIR__ . '/src/views/curriculum.php';
        break;
    case '/login':
      case '/login/':
        require __DIR__ . '/src/views/login.php';
        break;
    case '/logout':
        require __DIR__ . '/src/routes/logout.route.php';
        break;
    case '/backoffice':
      case '/backoffice/':
        if(AuthController::isAdmin()){
          require __DIR__ . '/src/views/backoffice.php';
        }else{
          require __DIR__ . '/src/views/login.php';
        }
        break;
    case '/backoffice/delete/':
        if(AuthController::isAdmin()){
          require __DIR__ . '/src/routes/curriculum/delete.route.php';
        }else{
          require __DIR__ . '/src/views/error403.php';
        }
        break;
    case '/backoffice/edit/':
        if(AuthController::isAdmin()){
          require __DIR__ . '/src/views/edit.php';
        }else{
          require __DIR__ . '/src/views/error403.php';
        }
        break;
    case '/api/edit/': 
        if(AuthController::isAdmin()) {
          require __DIR__ . '/src/routes/curriculum/edit.route.php';
        }else{
          require __DIR__ . '/src/views/error403.php';
        }
        break;
    case '/api/contact/':
        require __DIR__ . '/src/routes/contact/create.route.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/src/views/error404.php'; 
        break;
  }