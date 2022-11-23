<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/role.service.php';

    class RoleController {

        public static function index() {
            return Role::index();
        }

        public static function create($name, $description) {
            $role = new Role($name, $description);

            if($role->exists()) return false;
            return $role->create();
        }

        public static function exists($name) {
            $role = new Role($name);
            return $role->exists();
        }

        public static function get($id) {
            $role = new Role();
            $role->id = $id;
            return $role->getByID($id);
        }

    }

