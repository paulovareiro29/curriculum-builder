<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

    class Role extends Database {
        public $id;
        public $name;
        public $description;

        public function __construct($name = "", $description = "") {
            $this->name = $name;
            $this->description = $description;
        }

        public function create(){
            $sql = "INSERT INTO role (name, description) VALUES (?,?)";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->name, $this->description]);
            $result = $stmt->fetch();
            $this->close();

            if($result) return true;
            return false;
        }

        public function get() {
            $sql = "SELECT * FROM role WHERE name LIKE ?";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->name]);
            $result = $stmt->fetch();
            $this->close();

            if($result) return $result;
            return null;
        }

        public function getByID() {
            $sql = "SELECT * FROM role WHERE id = :id";

            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $this->id]);
            $result = $stmt->fetch();
            $this->close();

            if($result) return $result;
            return null;
        }

        public function exists(){
            return $this->get() !== null;
        }
    }