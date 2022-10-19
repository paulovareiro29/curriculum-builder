<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/curriculum.service.php';

    class CurriculumController {

        public static function index() {
            return Curriculum::index();
        }

        public static function create($name, $person_name) {
            $curriculum = new Curriculum();
            $curriculum->name = $name;
            $curriculum->person_name = $person_name;
            return $curriculum->create();
        }

    }