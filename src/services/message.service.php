<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

    class Message extends Database {
        public $id;
        public $curriculum_id;
        public $user_id;
        public $first_name;
        public $last_name;
        public $email;
        public $phone;
        public $subject;
        public $message;


        public function __construct($id = null) {
            $this->id = $id;
        }

        public function create(){
            $sql = "INSERT INTO message (curriculum_id, user_id, first_name, last_name, email, phone, subject, message) VALUES (?,?,?,?,?,?,?,?)";

            $this->connect();

            $stmt = $this->conn->stmt_init();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iissssss", $this->curriculum_id, $this->user_id, $this->first_name, $this->last_name, $this->email, $this->phone, $this->subject, $this->message);
            $result = $stmt->execute();

            $this->close();

            if($result == 1){
                return true;
            }

            return false;
        }

        public function get() {
            $sql = "SELECT * FROM message WHERE id = " . $this->id;

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if(!isset($result) || $result->num_rows <= 0) return null;

            foreach ($result as $row) return $row;
        }

        public static function indexByCurriculum($id) {
            $sql = "SELECT * FROM message WHERE curriculum_id = " . $id . " ORDER BY created_at DESC";

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
            $sql = "SELECT * FROM message WHERE user_id = " . $id . " ORDER BY created_at DESC";

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
    }