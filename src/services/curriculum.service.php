<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

    class Curriculum extends Database {
        public $id;
        public $name;
        public $person_name;
        public $avatar;
        public $profile;
        public $info;
        public $skills;
        public $education;
        public $experience;

        public function __construct($id = null) {
            $this->$id = $id;
        }

        public function create(){
            $sql = "INSERT INTO curriculum (name, person_name, avatar) VALUES (?,?,?)";

            $this->connect();
            
            $stmt = $this->conn->stmt_init();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $this->name, $this->person_name, $this->avatar);
            $result = $stmt->execute();

            $this->close();

            if($result == 1){
                return true;
            }

            return false;
        }

        public function get(){
            $sql = "SELECT * FROM curriculum WHERE id = " . $this->id;

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if(!isset($result) || $result->num_rows <= 0) return null;

            foreach ($result as $row) return $row;
        }

        public static function index() {
            $sql = "SELECT * FROM curriculum";

            $conn = new mysqli($_ENV['DB_SERVER'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

            if($conn->connect_error) {
                die("Connection to Database has failed: " . $conn->connect_error);
            }

            $result = $conn->query($sql);
            $conn->close();

            return $result;
        }
    }
