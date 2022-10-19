<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

    class User extends Database {
        public $username;
        private $password;

        public function __construct($username, $password) {
            $this->username = $username;
            $this->password = password_hash($password, PASSWORD_BCRYPT);
        }

        public function create(){
            $sql = "INSERT INTO user (username, password) VALUES (?,?)";

            $this->connect();

            $stmt = $this->conn->stmt_init();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $this->username, $this->password);
            $result = $stmt->execute();

            $this->close();

            if($result == 1){
                return true;
            }

            return false;
        }

        
    }