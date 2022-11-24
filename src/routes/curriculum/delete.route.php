<?php 
    if(!isset($_GET['id']) || empty($_GET['id'])){
        http_response_code(400);
        die("Missing ID");
    }

    $id = $_GET['id'];

    $curriculum = CurriculumController::get($id);

    if($curriculum === null) {
        http_response_code(404);
        die("Curriculum not found");
    }

    $user = UserController::getByUsername($_SESSION["user"]);

    if($user === null || $curriculum === null) {
        http_response_code(400);
        die("Invalid request");
    } 

    if($curriculum['user_id'] !== $user['id'] && !AuthController::isAdmin()){
        http_response_code(403);
        die("Unauthorized");
    }

    $success = CurriculumController::delete($id);
        
    if(!$success){
        http_response_code(400);
        die();
    }
        
    http_response_code(200);
    die();
