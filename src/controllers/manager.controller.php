<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/user.service.php';
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/curriculum.service.php';

    class ManagerController {
        public static function index(){
            $result = User::indexManagers();
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

        public static function indexByCurriculum($id) {
            $result = Curriculum::indexManagers($id);
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

        public static function deleteByCurriculum($id) {
            return Curriculum::deleteAllManagers($id);
        }

        public static function create($curriculum_id, $user_id) {
            $curriculum = new Curriculum($curriculum_id);
            return $curriculum->addManager($user_id);
        }
    }
?>