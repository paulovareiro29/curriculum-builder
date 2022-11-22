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
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->curriculum_id, $this->start_date, $this->end_date, $this->school, $this->course, $this->location]);
            $this->close();

            if($stmt->rowCount() > 0) return true;
            return false;
        }

        public function get(){
            $sql = "SELECT * FROM education WHERE id = :id";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $this->id]);
            $result = $stmt->fetch();
            $this->close();

            if($result) return $result;
            return null;
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
            $stmt = $this->conn->query($sql);
            $this->close();

            if($stmt->rowCount() > 0) return true;
            return false;
        }

        public static function index() {
            $sql = "SELECT * FROM education";

            $db = new Database();
            $db->connect();

            $stmt = $db->conn->query($sql);
            $result = $stmt->fetchAll();
            $db->close();

            return $result;
        }

        public static function indexByCurriculum($id) {
            $sql = "SELECT * FROM education WHERE curriculum_id = :id";

            $db = new Database();
            $db->connect();

            $stmt = $db->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetchAll();
            $db->close();

            return $result;
        }

        public static function deleteByCurriculum($id) {
            $sql = "DELETE FROM education WHERE curriculum_id = :id";

            $db = new Database();
            $db->connect();

            $stmt = $db->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $db->close();

            if($stmt->rowCount() > 0) return true;
            return false;
        }



    }