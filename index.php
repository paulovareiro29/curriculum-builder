<?php
require_once __DIR__ . '/config.php';

if (!RoleController::exists($_ENV['ADMIN_ROLE'])) RoleController::create($_ENV['ADMIN_ROLE'], "Administrator Role");
if (!RoleController::exists($_ENV['MANAGER_ROLE'])) RoleController::create($_ENV['MANAGER_ROLE'], "Manager Role");


if (!UserController::validate($_ENV['ROOT_USERNAME'], $_ENV['ROOT_PASSWORD'])) {
  UserController::create($_ENV['ROOT_USERNAME'], $_ENV['ROOT_PASSWORD']);
}

if (!UserController::hasRole($_ENV['ROOT_USERNAME'], $_ENV['ADMIN_ROLE'])) {
  UserController::addRole($_ENV['ROOT_USERNAME'], $_ENV['ADMIN_ROLE']);
}

session_start();

$dir = $_SERVER['REQUEST_URI'];
$baseUri = substr_replace($dir, "", strpos($dir, "/curriculum"), strlen("/curriculum"));

if (strpos($baseUri, "?")) {
  $baseUri = substr($baseUri, 0, strpos($baseUri, "?"));
}

switch ($baseUri) {
  case '':
  case '/':
    require __DIR__ . '/src/views/landing.php';
    break;
  case '/showcase/':
  case '/showcase':
    require __DIR__ . '/src/views/showcase.php';
    break;
  case '/view/':
  case '/view':
    require __DIR__ . '/src/views/curriculum.php';
    break;
  case '/login':
  case '/login/':
    require __DIR__ . '/src/views/login.php';
    break;
  case '/register':
  case '/register/':
    require __DIR__ . '/src/views/register.php';
    break;
  case '/logout':
    require __DIR__ . '/src/routes/logout.route.php';
    break;
  case '/backoffice':
  case '/backoffice/':
    if (AuthController::isLoggedIn()) {
      require __DIR__ . '/src/views/backoffice.php';
    } else {
      require __DIR__ . '/src/views/login.php';
    }
    break;
  case '/salary':
  case '/salary/':
    require __DIR__ . '/src/views/salary.php';
    break;
  case '/users':
  case '/users/':
    if (AuthController::isAdmin()) {
      require __DIR__ . '/src/views/users.php';
    } else {
      require __DIR__ . '/src/views/login.php';
    }
    break;
  case '/users/edit':
  case '/users/edit/':
    if (AuthController::isAdmin()) {
      require __DIR__ . '/src/views/editUser.php';
    } else {
      require __DIR__ . '/src/views/login.php';
    }
    break;
  case '/api/delete':
  case '/api/delete/':
    if (AuthController::isLoggedIn()) {
      require __DIR__ . '/src/routes/curriculum/delete.route.php';
    } else {
      require __DIR__ . '/src/views/error403.php';
    }
    break;
  case '/backoffice/edit':
  case '/backoffice/edit/':
    if (AuthController::isLoggedIn()) {
      require __DIR__ . '/src/views/editCurriculum.php';
    } else {
      require __DIR__ . '/src/views/error403.php';
    }
    break;
  case '/backoffice/messages':
  case '/backoffice/messages/':
    if (AuthController::isLoggedIn()) {
      require __DIR__ . '/src/views/messages.php';
    } else {
      require __DIR__ . '/src/views/error403.php';
    }
    break;
  case '/api/edit':
  case '/api/edit/':
    if (AuthController::isLoggedIn()) {
      require __DIR__ . '/src/routes/curriculum/edit.route.php';
    } else {
      require __DIR__ . '/src/views/error403.php';
    }
    break;
  case '/api/user/edit':
  case '/api/user/edit/':
    if (AuthController::isLoggedIn()) {
      require __DIR__ . '/src/routes/user/edit.route.php';
    } else {
      require __DIR__ . '/src/views/error403.php';
    }
    break;
  case '/api/message':
  case '/api/message/':
    require __DIR__ . '/src/routes/message/create.route.php';
    break;
  case '/api/message/read':
  case '/api/message/read/':
    if (AuthController::isLoggedIn()) {
      require __DIR__ . '/src/routes/message/read.route.php';
    } else {
      require __DIR__ . '/src/views/error403.php';
    }
    break;
  case '/api/message/unread':
  case '/api/message/unread/':
    if (AuthController::isLoggedIn()) {
      require __DIR__ . '/src/routes/message/unread.route.php';
    } else {
      require __DIR__ . '/src/routes/message/error403.php';
    }
    break;
  default:
    http_response_code(404);
    require __DIR__ . '/src/views/error404.php';
    break;
}
