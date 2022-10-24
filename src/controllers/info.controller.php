<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/info.service.php';

    class InfoController {

        public static function indexByCurriculum($id) {
            return Info::indexByCurriculum($id);
        }

        public static function create($curriculum_id, $href = null, $content) {
            $info = new Info();
            $info->curriculum_id = $curriculum_id;
            $info->href = $href;
            $info->content = $content;

            return $info->create();
        }

        public static function deleteByCurriculum($id){
            return Info::deleteByCurriculum($id);
        }

    }