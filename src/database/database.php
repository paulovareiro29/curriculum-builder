<?php

    class Database {
        public $conn = null;

        public function connect() {
            // Create connection
            $this->conn = new mysqli($_ENV['DB_SERVER'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

            // Check connection
            if($this->conn->connect_error) {
                die("Connection to Database has failed: " . $this->conn->connect_error);
            }
        }

        public function close() {
            $this->conn->close();
        }
    }