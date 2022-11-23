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
            $sql = "SELECT * FROM role WHERE id = " . $this->id;

            $this->connect();
            $result = $this->conn->query($sql);
            $this->close();

            if(!isset($result) || $result->num_rows <= 0) return null;

            foreach ($result as $row) return $row;
        }

        public function exists(){
            return $this->get() !== null;
        }
    }