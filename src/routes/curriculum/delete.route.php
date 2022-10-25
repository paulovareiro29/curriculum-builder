<?php 


     if(isset($_GET['id']) && $_GET['id']){
        $id = $_GET['id'];
        $success = CurriculumController::delete($id);
         
        if($success){
            http_response_code(200);
        }else{
            http_response_code(400);
        }
        /* echo "<script>window.location.href = '/{$_SERVER['BASE_DIR']}/backoffice?deleted=$result'</script>"; */
    }
    die();