<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/experience.service.php';

    class ExperienceController {

        public static function indexByCurriculum($id) {
            return Experience::indexByCurriculum($id);
        }

        public static function create($curriculum_id, $start_date, $end_date, $company, $role, $summary) {
            $experience = new Experience();
            $experience->curriculum_id = $curriculum_id;
            $experience->start_date = $start_date;
            $experience->end_date = $end_date;
            $experience->company = $company;
            $experience->role = $role;
            $experience->summary = $summary;


            return $experience->create();
        }

        public static function deleteByCurriculum($id){
            return Experience::deleteByCurriculum($id);
        }

    }