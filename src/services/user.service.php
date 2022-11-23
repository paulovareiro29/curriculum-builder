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
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->username, $password]);
            $this->close();

            if($stmt->rowCount() > 0) return true;
            return false;
        }

        public function get() {
            $sql = "SELECT * FROM user WHERE username LIKE :username";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $this->username]);
            $result = $stmt->fetch();
            $this->close();

            if($result) return $result;
            return null;
        }

        public function getByID() {
            $sql = "SELECT * FROM user WHERE id = :id";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $this->id]);
            $result = $stmt->fetch();
            $this->close();

            if($result) return $result;
            return null;
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

            $sql = "SELECT * FROM user_role WHERE user_id = :userid AND role_id = :roleid";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['userid' => $user['id'], 'roleid' => $role['id']]);
            $result = $stmt->fetch();
            $this->close();

            if($result) return true;
            return false;
        }

        public function addRole($rolename) {
            if($this->hasRole($rolename)) return false;

            $role = new Role($rolename);
            if(($role = $role->get()) === null) return false;
            $user = $this->get();

            $sql = "INSERT INTO user_role (user_id, role_id) VALUES (?,?)";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user['id'], $role['id']]);
            $this->close();

            if($stmt->rowCount() > 0) return true;
            return false;
        }

        public function removeRole($rolename) {
            if($this->hasRole($rolename)) return false;

            $role = new Role($rolename);
            if(($role = $role->get()) === null) return false;
            $user = $this->get();

            $sql = "DELETE FROM user_role WHERE user_id = :userid AND role_id = :roleid";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['userid' => $user['id'], 'roleid' => $role['id']]);
            $this->close();

            if($stmt->rowCount() > 0) return true;
            return false;
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