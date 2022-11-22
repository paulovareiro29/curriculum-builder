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
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->curriculum_id, $this->user_id, $this->first_name, $this->last_name, $this->email, $this->phone, $this->subject, $this->message]);
            $this->close();

            if($stmt->rowCount() > 0) return true;
            return false;
        }

        public function get() {
            $sql = "SELECT * FROM message WHERE id = :id";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $this->id]);
            $result = $stmt->fetch();
            $this->close();

            if($result) return $result;
            return null;
        }

        public static function indexByCurriculum($id) {
            $sql = "SELECT * FROM message WHERE curriculum_id = :id ORDER BY created_at DESC";

            $db = new Database();
            $db->connect();

            $stmt = $db->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetchAll();
            $db->close();

            return $result;
        }

        public static function indexByUser($id) {
            $sql = "SELECT * FROM message WHERE user_id = :id ORDER BY created_at DESC";

            $db = new Database();
            $db->connect();

            $stmt = $db->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetchAll();
            $db->close();

            return $result;
        }
    }