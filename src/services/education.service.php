<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

    class Education extends Database {
        public $id;
        public $curriculum_id;
        public $start_date;
        public $end_date;
        public $school;
        public $course;
        public $location;

        public function __construct($id = null) {
            $this->id = $id;
        }

        public function create() {
            $sql = "INSERT INTO education (curriculum_id, start_date, end_date, school, course, location) VALUES (?,?,?,?,?,?)";

            $this->connect();

            $stmt = $this->conn->stmt_init();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isssss", $this->curriculum_id, $this->start_date, $this->end_date, $this->school, $this->course, $this->location);
            $result = $stmt->execute();

            $this->close();

            return $result;
        }

        public function get(){
            $sql = "SELECT * FROM education WHERE id = " . $this->id;

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if(!isset($result) || $result->num_rows <= 0) return null;

            foreach ($result as $row) return $row;
        }

        public function update() {
            $sql = "UPDATE education SET 
                start_date = '{$this->start_date}',
                end_date = '{$this->end_date}',
                school = '{$this->school}',
                course = '{$this->course}',
                location = '{$this->location}'
                WHERE id = {$this->id}";
            
            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            return $result;
        }

        public static function index() {
            $sql = "SELECT * FROM education";

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

        public static function indexByCurriculum($id) {
            $sql = "SELECT * FROM education WHERE curriculum_id = " . $id;

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

        public static function deleteByCurriculum($id) {
            $sql = "DELETE FROM education WHERE curriculum_id = " . $id;

            $conn = new mysqli($_ENV['DB_SERVER'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

            if($conn->connect_error) {
                die("Connection to Database has failed: " . $conn->connect_error);
            }

            $result = $conn->query($sql);
            $conn->close();

            return $result;
        }



    }