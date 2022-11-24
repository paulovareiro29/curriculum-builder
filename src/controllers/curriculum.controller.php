<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/curriculum.service.php';
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/user.service.php';
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/controllers/info.controller.php';
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/controllers/skill.controller.php';
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/controllers/education.controller.php';
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/controllers/experience.controller.php';

    class CurriculumController {

        public static function index() {
            return Curriculum::index();
        }

        public static function indexByUser($username) {
            $user = new User($username);
            if(($user = $user->get()) === null) return false;

            $array = Curriculum::indexByUser($user['id']);

            foreach($array as $key => $curriculum) {
                $messages = MessageController::indexByCurriculum($curriculum['id']);
                $array[$key]['unread_messages'] = false;

                foreach($messages as $message) {
                    if(!$message['viewed']){
                        $array[$key]['unread_messages'] = true;
                        break;
                    }
                }
            }

            return $array;
        }

        public static function get($id){
            $curriculum = new Curriculum($id);
            $curriculum = $curriculum->get();

            if($curriculum === null) return null;

            $curriculum['info'] = InfoController::indexByCurriculum($id);
            $curriculum['skills'] = SkillController::indexByCurriculum($id);
            $curriculum['education'] = EducationController::indexByCurriculum($id);
            $curriculum['experience'] = ExperienceController::indexByCurriculum($id);
            $curriculum['managers'] = ManagerController::indexByCurriculum($id);

            $messages = MessageController::indexByCurriculum($curriculum['id']);
            $curriculum['unread_messages'] = false;

            foreach($messages as $message) {
                if(!$message['viewed']){
                    $curriculum['unread_messages'] = true;
                    break;
                }
            }

            return $curriculum;
        }

        public static function create($username, $name, $description = "", $avatar = "") {
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

        public static function update($id, $data) {
            $curriculum = new Curriculum($id);
            if($curriculum->get() === null) return false;
            foreach($data as $key => $field) {
               $curriculum->$key = $field;
            }

            return $curriculum->update();
        }

        public static function isManager($id, $userid) {
            $managers = Curriculum::indexManagers($id);
            foreach($managers as $manager) {
                if($manager['id'] == $userid) return true;
            }

            return false;
        }

    }