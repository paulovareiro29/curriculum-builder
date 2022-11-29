<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/education.service.php';

class EducationController
{

    public static function indexByCurriculum($id)
    {
        return Education::indexByCurriculum($id);
    }

    public static function create($curriculum_id, $start_date, $end_date, $school, $course, $location)
    {
        $education = new Education();
        $education->curriculum_id = $curriculum_id;
        $education->start_date = $start_date;
        $education->end_date = $end_date;
        $education->school = $school;
        $education->course = $course;
        $education->location = $location;


        return $education->create();
    }

    public static function deleteByCurriculum($id)
    {
        return Education::deleteByCurriculum($id);
    }
}
