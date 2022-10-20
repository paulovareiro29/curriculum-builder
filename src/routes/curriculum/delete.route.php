<?php 


     if(isset($_GET['id']) && $_GET['id']){
        $id = $_GET['id'];
        $result = CurriculumController::delete($id);
         
        if($result == 0) $result = 2;
        echo "<script>window.location.href = '/{$_SERVER['BASE_DIR']}/backoffice?deleted=$result'</script>";
       
    }