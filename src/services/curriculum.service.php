<?php 
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

    class Curriculum extends Database {
        public $id;
        public $user_id;
        public $name;
        public $person_name;
        public $avatar;
        public $summary;
        public $profile_header;
        public $info_header;
        public $skills_header;
        public $education_header;
        public $experience_header;

        public function __construct($id = null) {
            $this->id = $id;
        }

        public function create(){
            $sql = "INSERT INTO curriculum (user_id, name, description, avatar) VALUES (?,?,?,?)";

            $this->connect();
            
            $stmt = $this->conn->stmt_init();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isss", $this->user_id, $this->name, $this->description, $this->avatar);
            $result = $stmt->execute();

            $this->close();

            if($result == 1){
                return true;
            }

            return false;
        }

        public function get(){
            $sql = "SELECT * FROM curriculum WHERE deleted_at IS NULL AND id = " . $this->id;

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if(!isset($result) || $result->num_rows <= 0) return null;

            foreach ($result as $row){
                foreach($row as $key => $field) {
                    $this->$key = $field;
                 }
                return $row;
            }
        }

        public static function index() {
            $sql = "SELECT * FROM curriculum WHERE deleted_at IS NULL";

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

        public static function indexByUser($id) {
            $sql = "SELECT * FROM curriculum WHERE deleted_at IS NULL AND user_id = " . $id;

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

        public function softdelete() {
            if(!isset($this->id)) return false;

            $sql = "UPDATE curriculum SET deleted_at = now() WHERE id = " . $this->id;

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if($result == 1){
                return true;
            }

            return false;
        }

        public function update() {
            $sql = "UPDATE curriculum SET 
                name = '{$this->name}',
                person_name = '{$this->person_name}',
                avatar = '{$this->avatar}',
                summary = '{$this->summary}',
                profile_header = '{$this->profile_header}',
                info_header = '{$this->info_header}',
                skills_header = '{$this->skills_header}',
                education_header = '{$this->education_header}',
                experience_header = '{$this->experience_header}'
                WHERE id = {$this->id}";
            
            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            return $result;
        }
    }
