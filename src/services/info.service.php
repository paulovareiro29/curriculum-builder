<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

    class Info extends Database {
        public $id;
        public $curriculum_id;
        public $href;
        public $content;
        public $icon;

        public function __construct($id = null) {
            $this->id = $id;
        }

        public function create() {
            $sql = "INSERT INTO info (curriculum_id, href, content, icon) VALUES (?,?,?,?)";

            $this->connect();

            $stmt = $this->conn->stmt_init();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isss", $this->curriculum_id, $this->href, $this->content, $this->icon);
            $result = $stmt->execute();

            $this->close();

            return $result;
        }

        public function get(){
            $sql = "SELECT * FROM info WHERE id = " . $this->id;

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if(!isset($result) || $result->num_rows <= 0) return null;

            foreach ($result as $row) return $row;
        }

        public function update() {
            $sql = "UPDATE info SET 
                href = '{$this->href}',
                content = '{$this->content}',
                icon = '{$this->icon}'
                WHERE id = {$this->id}";
            
            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            return $result;
        }

        public static function index() {
            $sql = "SELECT * FROM info";

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
            $sql = "SELECT * FROM info WHERE curriculum_id = " . $id;

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
            $sql = "DELETE FROM info WHERE curriculum_id = " . $id;

            $conn = new mysqli($_ENV['DB_SERVER'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

            if($conn->connect_error) {
                die("Connection to Database has failed: " . $conn->connect_error);
            }

            $result = $conn->query($sql);
            $conn->close();

            return $result;
        }



    }