<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/curriculum.service.php';

    class CurriculumController {

        public static function index() {
            return Curriculum::index();
        }

        public static function create($name, $description, $avatar) {
            $curriculum = new Curriculum();
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