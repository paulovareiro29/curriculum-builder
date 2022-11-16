<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/user.service.php';

    class UserController {

        public static function create($username, $password) {
            $user = new User($username, $password);

            if($user->exists()) return false;
            return $user->create();
        }

        public static function get($id){
            $user = new User();
            $user->id = $id;
            return $user->getByID();
        }

        public static function index(){
            return User::index();
        }

        public static function getByUsername($username){
            $user = new User($username);
            return $user->get();
        }

        public static function validate($username, $password) {
            $user = new User($username, $password);
            return $user->validate();
        }

        public static function hasRole($username, $rolename) {
            $user = new User($username);
            return $user->hasRole($rolename);
        }

        public static function addRole($username, $rolename) {
            $user = new User($username);

            if(!$user->exists()) return false;
            return $user->addRole($rolename);
        }

        public static function removeRole($username, $rolename) {
            $user = new User($username);
            return $user->removeRole($rolename);
        }

        public static function isAdmin($username) {
            return self::hasRole($username, $_ENV['ADMIN_ROLE']);
        }
    }

