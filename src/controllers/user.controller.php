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
            $result = $user->getByID();

            if(!isset($result)) return null;

            $user->username = $result["username"];
            $roles = $user->indexRoles();

            $array = [];
            foreach ($roles as $role) {
                array_push($array, RoleController::get($role["role_id"]));
            }
            $result["roles"] = $array;
            return $result;
        }

        public static function index(){
            $result = User::index();
            foreach ($result as $key => $item){
                $user = new User($item["username"]);                
                $roles = $user->indexRoles();

                $array = [];
                foreach ($roles as $role) {
                    array_push($array, RoleController::get($role["role_id"]));
                }
                $result[$key]["roles"] = $array;
            }
            return $result;
        }

        public static function getByUsername($username){
            $user = new User($username);
            $roles = $user->indexRoles();

            $array = [];
            foreach ($roles as $role) {
                array_push($array, RoleController::get($role["role_id"]));
            }
            $result = $user->get();
            $result["roles"] = $array;
            return $result;
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

