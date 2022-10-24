<?php

    $data = json_decode(file_get_contents('php://input'), true);
    CurriculumController::update($_GET['id'], $data);
    http_response_code(200);
    die();