<?php

    class AuthController {

        public static function isLoggedIn() {
            return isset($_SESSION["user"]);
        }

        public static function redirectTo($location) {
            echo "<script>window.location.href = '$location'</script>";
        }

        public static function redirectToIndex() {
            self::redirectTo("/" . $_ENV['BASE_DIR']);
        }
        
        public static function nonLoggedRedirect() {
            if(!self::isLoggedIn()) {
                self::redirectToIndex();
                return true;
            }

            return false;
        }

        public static function nonAdminRedirect() {
            if(self::nonLoggedRedirect()) {
                return true;
            }

            if(!UserController::isAdmin($_SESSION["user"])) {
                self::redirectToIndex();
                return true;
            }

            return false;
        }

        public static function isAdmin() {
            return self::isLoggedIn() && UserController::isAdmin($_SESSION["user"]);
        }
    }

