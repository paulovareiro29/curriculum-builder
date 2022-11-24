<?php
    if(!AuthController::isAdmin()){
    AuthController::redirectTo("/" . $_ENV['BASE_DIR'] . "/backoffice");
    return;
    }

    $id = $_GET['id'];

    if(!isset($_GET['id']) || empty($_GET['id'])) {
        http_response_code(400);
        die();
    }
    
    $user = UserController::get($id);
    $data = json_decode(file_get_contents('php://input'), true);

    $results = [];
    $roles = $data['roles'];
    if(isset($roles)){
        UserController::removeAllRoles($user['username']);
        foreach($roles as $item){
            $role = RoleController::get($item);
            array_push($results, UserController::addRole($user['username'], $role['name']));
        }
    }

    http_response_code(200);
    var_dump($results);
    die();