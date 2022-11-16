<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/services/role.service.php';

    class User extends Database {
        public $username;
        public $password;

        public function __construct($username = "", $password = "") {
            $this->username = $username;
            $this->password = $password;
        }

        public function create(){
            $sql = "INSERT INTO user (username, password) VALUES (?,?)";
            $password = password_hash($this->password, PASSWORD_BCRYPT);

            $this->connect();

            $stmt = $this->conn->stmt_init();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $this->username, $password);
            $result = $stmt->execute();

            $this->close();

            if($result == 1){
                return true;
            }

            return false;
        }

        public function get() {
            $sql = "SELECT * FROM user WHERE username LIKE \"" . $this->username . "\"";

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if(!isset($result) || $result->num_rows <= 0) return null;

            foreach ($result as $row) return $row;
        }

        public function getByID() {
            $sql = "SELECT * FROM user WHERE id = " . $this->id;

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if(!isset($result) || $result->num_rows <= 0) return null;

            foreach ($result as $row) return $row;
        }

        public static function index() {
            $sql = "SELECT * FROM user";

            $conn = new mysqli($_ENV['DB_SERVER'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

            if($conn->connect_error) {
                die("Connection to Database has failed: " . $conn->connect_error);
            }

            $result = $conn->query($sql);
            $conn->close();

            $array = array();
            foreach ($result as $row){
                array_push($array, $row);
            }

            return $array;
        }

        public function exists(){
            return $this->get() !== null;
        }

        public function validate(){
            $user = $this->get();

            if($user === null) return false;
            
            return password_verify($this->password, $user['password']);
        }

        public function hasRole($rolename) {
            $role = new Role($rolename);
            if(($role = $role->get()) === null) return false;
            $user = $this->get();

            $sql = "SELECT * FROM user_role WHERE user_id = " . $user['id'] . " AND role_id = " . $role['id'];

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if(!isset($result) || $result->num_rows <= 0) return false;

            return true;
        }

        public function addRole($rolename) {
            if($this->hasRole($rolename)) return false;

            $role = new Role($rolename);
            if(($role = $role->get()) === null) return false;
            $user = $this->get();

            $sql = "INSERT INTO user_role (user_id, role_id) VALUES (?,?)";

            $this->connect();
            $stmt = $this->conn->stmt_init();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $user['id'], $role['id']);
            $result = $stmt->execute();
            $this->close();

            if($result == 1){
                return true;
            }

            return false;
        }

        public function removeRole($rolename) {
            if($this->hasRole($rolename)) return false;

            $role = new Role($rolename);
            if(($role = $role->get()) === null) return false;
            $user = $this->get();

            $sql = "DELETE FROM user_role WHERE user_id = " . $user['id'] . " AND role_id = " . $role['id'];

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            return $result;
        }

        public function indexRoles() {
            $user = $this->get();

            $sql = "SELECT * FROM user_role WHERE user_id = " . $user['id'];

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            $array = array();
            foreach ($result as $row){
                array_push($array, $row);
            }

            return $array;
        }
    }