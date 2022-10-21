<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/curriculum.service.php';
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/user.service.php';

    class CurriculumController {

        public static function index() {
            return Curriculum::index();
        }

        public static function indexByUser($username) {
            $user = new User($username);
            if(($user = $user->get()) === null) return false;

            return Curriculum::indexByUser($user['id']);
        }

        public static function create($username, $name, $description, $avatar) {
            $user = new User($username);
            if(($user = $user->get()) === null) return false;

            $curriculum = new Curriculum();
            $curriculum->user_id = $user['id'];
            $curriculum->name = $name;
            $curriculum->description = $description;
            $curriculum->avatar = $avatar;
            
            return $curriculum->create();
        }

        public static function delete($id) {
            $curriculum = new Curriculum($id);
            return $curriculum->softdelete();
        }

    }