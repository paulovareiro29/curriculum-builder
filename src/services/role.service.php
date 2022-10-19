<?php
    include_once "{$_SERVER['DOCUMENT_ROOT']}/{$_ENV['SRC_DIR']}" . '/database/database.php';

    class Role extends Database {
        public $name;
        public $description;

        public function __construct($name, $description = "") {
            $this->name = $name;
            $this->description = $description;
        }

        public function create(){
            $sql = "INSERT INTO role (name, description) VALUES (?,?)";

            $this->connect();

            $stmt = $this->conn->stmt_init();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $this->name, $this->description);
            $result = $stmt->execute();

            $this->close();

            if($result == 1){
                return true;
            }

            return false;
        }

        public function get() {
            $sql = "SELECT * FROM role WHERE name LIKE \"" . $this->name . "\"";

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