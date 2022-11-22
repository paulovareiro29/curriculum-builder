<?php

if(isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
    
    AuthController::redirectTo("./");
}