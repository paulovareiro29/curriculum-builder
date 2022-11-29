<?php
$data = json_decode(file_get_contents('php://input'), true);

$success = MessageController::create($data['curriculum_id'], $data['user_id'], $data['first_name'], $data['last_name'], $data['email'], $data['phone'], $data['subject'], $data['message']);

if ($success) {
    http_response_code(200);
} else {
    http_response_code(400);
}

die();
