<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/user.service.php';


    class UserController {

        public static function create($username, $password) {
            $user = new User($username, $password);
            return $user->create();
        }

    }

