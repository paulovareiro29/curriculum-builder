<?php
    $id = $_GET['id'];
    $data = json_decode(file_get_contents('php://input'), true);

    $curriculum = array_diff_key($data, ['info' => []]);
    CurriculumController::update($id, $curriculum);

    $info = $data['info'];
    if(isset($info)){
        InfoController::deleteByCurriculum(($id));
        foreach($info as $item){
            InfoController::create($id, $item['href'], $item['content']);
        }
    }


    $skills = $data['skills'];
    if(isset($skills)){
        SkillController::deleteByCurriculum(($id));
        foreach($skills as $item){
            SkillController::create($id, $item['content'], $item['rating']);
        }
    }


    $education = $data['education'];
    if(isset($education)){
        EducationController::deleteByCurriculum(($id));
        foreach($education as $item){
            EducationController::create($id, $item['start_date'], $item['end_date'], $item['school'], $item['course'], $item['location']);
        }
    }


    http_response_code(200);
    die();