<?php 

    if(!isset($_GET['id']) || empty($_GET['id'])){
        http_response_code(400);
        die();
    }

    $id = $_GET['id'];

    $result = MessageController::markAsUnread($id);

    if(!$result){
        http_response_code(500);
        die("Server error");
    }

    http_response_code(200);
    die();