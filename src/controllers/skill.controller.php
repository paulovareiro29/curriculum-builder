<?php
include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/skill.service.php';

class SkillController
{

    public static function indexByCurriculum($id)
    {
        return Skill::indexByCurriculum($id);
    }

    public static function create($curriculum_id, $content,  $rating = 0)
    {
        $skill = new Skill();
        $skill->curriculum_id = $curriculum_id;
        $skill->content = $content;
        $skill->rating = $rating;

        return $skill->create();
    }

    public static function deleteByCurriculum($id)
    {
        return Skill::deleteByCurriculum($id);
    }
}
