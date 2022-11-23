<?php 
    if(!isset($_GET['id']) || empty($_GET['id'])){
        http_response_code(400);
        die("Missing ID");
    }

    $id = $_GET['id'];

    $result = MessageController::markAsRead($id);

    if(!$result){
        http_response_code(500);
        die("Server error");
    }

    http_response_code(200);
    die();