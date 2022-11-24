<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

    class Experience extends Database {
        public $id;
        public $curriculum_id;
        public $start_date;
        public $end_date;
        public $company;
        public $role;
        public $summary;

        public function __construct($id = null) {
            $this->id = $id;
        }

        public function create() {
            $sql = "INSERT INTO experience (curriculum_id, start_date, end_date, company, role, summary) VALUES (?,?,?,?,?,?)";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->curriculum_id, $this->start_date, $this->end_date, $this->company, $this->role, $this->summary]);
            $this->close();

            if($stmt->rowCount() > 0) return true;
            return false;
        }

        public function get(){
            $sql = "SELECT * FROM experience WHERE id = :id";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $this->id]);
            $result = $stmt->fetch();
            $this->close();

            if($result) return $result;
            return null;
        }

        public function update() {
            $data = [
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'company' => $this->company,
                'role' => $this->role,
                'summary' => $this->summary,
                'id' => $this->id,
            ];
            
            $sql = "UPDATE experience SET 
                start_date = :start_date,
                end_date = :end_date,
                company = :company,
                role = :role,
                summary = :summary
                WHERE id = :id";
            
            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            $this->close();

            if($stmt->rowCount() > 0) return true;
            return false;
        }

        public static function index() {
            $sql = "SELECT * FROM experience";

            $db = new Database();
            $db->connect();

            $stmt = $db->conn->query($sql);
            $result = $stmt->fetchAll();
            $db->close();

            return $result;
        }

        public static function indexByCurriculum($id) {
            $sql = "SELECT * FROM experience WHERE curriculum_id = :id";

            $db = new Database();
            $db->connect();

            $stmt = $db->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetchAll();
            $db->close();

            return $result;
        }

        public static function deleteByCurriculum($id) {
            $sql = "DELETE FROM experience WHERE curriculum_id = :id";

            $db = new Database();
            $db->connect();

            $stmt = $db->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $db->close();

            if($stmt->rowCount() > 0) return true;
            return false;
        }



    }