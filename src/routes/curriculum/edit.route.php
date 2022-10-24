<?php

    $data = json_decode(file_get_contents('php://input'), true);
    CurriculumController::update($_GET['id'], $data);

    die();