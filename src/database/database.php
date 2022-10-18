<?php
    class Database {
        const name = "curriculum";
        const server = "localhost";
        const username = "root";
        const password = "";

        public $conn = null;

        public function openConnection() {
            // Create connection
            $this->conn = new mysqli(self::server, self::username, self::password, self::name);

            // Check connection
            if($this->conn->connect_error) {
                die("Connection to Database has failed: " . $this->conn->connect_error);
            }
        }

        public function closeConnection() {
            $this->conn->close();
        }
    }