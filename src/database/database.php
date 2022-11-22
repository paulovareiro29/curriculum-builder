<?php

    class Database {
        public $conn = null;

        public function connect() {
            // Create connection
            $dsn = "mysql:host={$_ENV['DB_SERVER']};dbname={$_ENV['DB_NAME']};charset=utf8";

            try {
                $this->conn = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'] );
            }catch(PDOException $e) {
                die("Connection to Database has failed");
            }
        }

        public function close() {
            /* $this->conn->closeCursor(); */
        }
    }