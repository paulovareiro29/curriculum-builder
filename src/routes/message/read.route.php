<?php 
    if(!isset($_GET['id']) || empty($_GET['id'])){
        http_response_code(400);
        die("Missing ID");
    }

    $id = $_GET['id'];

    $message = MessageController::get($id);

    if($message === null) {
        http_response_code(404);
        die("Message not found");
    }

    $user = UserController::getByUsername($_SESSION["user"]);
    $curriculum = CurriculumController::get($message['curriculum_id']);

    if($user === null || $curriculum === null) {
        http_response_code(400);
        die("Invalid request");
    } 

    if($curriculum['user_id'] !== $user['id'] && !CurriculumController::isManager($curriculum['id'], $user['id']) && AuthController::isAdmin()){
        http_response_code(401);
        die("Unauthorized");
    }

    $result = MessageController::markAsRead($id);

    if(!$result){
        http_response_code(500);
        die("Server error");
    }

    http_response_code(200);
    die();