<?php
    if(!isset($_GET['id']) || empty($_GET['id'])){
        http_response_code(400);
        die("Missing ID");
    }

    $id = $_GET['id'];

    $curriculum = CurriculumController::get($id);

    if($curriculum === null) {
        http_response_code(404);
        die("Curriculum not found");
    }

    $user = UserController::getByUsername($_SESSION["user"]);

    if($user === null || $curriculum === null) {
        http_response_code(400);
        die("Invalid request");
    } 

    if($curriculum['user_id'] !== $user['id'] && !AuthController::isAdmin()){
        http_response_code(403);
        die("Unauthorized");
    }

    $data = json_decode(file_get_contents('php://input'), true);

    $curriculum = array_diff_key($data, ['info' => []]);
    
    var_dump(CurriculumController::update($id, $data));

    $results = [];
    $info = $data['info'];
    if(isset($info)){
        InfoController::deleteByCurriculum(($id));
        var_dump($info);
        foreach($info as $item){
            array_push($results,InfoController::create($id, $item['href'], $item['content'], $item['icon']));
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

    $experience = $data['experience'];
    if(isset($experience)){
        ExperienceController::deleteByCurriculum(($id));
        foreach($experience as $item){
            ExperienceController::create($id, $item['start_date'], $item['end_date'], $item['company'], $item['role'], $item['summary']);
        }
    }

    $managers = $data['managers'];
    if(isset($managers)){
        ManagerController::deleteByCurriculum(($id));
        foreach($managers as $manager_id){
            ManagerController::create($id, $manager_id);
        }
    }

    http_response_code(200);
    var_dump($results);
    die();