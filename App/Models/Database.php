<?php
    namespace App\Models;
    class Database {
        private const host = "localhost";
        private const username = "postgres";
        private const port = 5432;
        private const password = "mhmde0603";
        private const dbname = "YoudemyMVC";
        private static $instance;
        private $connection;

        public function __construct() {
            $db = "pgsql:host=".self::host .";port=".self::port .";dbname=".self::dbname .";user=".self::username .";password=".self::password;
            try{
                $this->connection = new \PDO($db);
                $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }catch (\PDOException $e){
                echo $e->getMessage();
            }
        }

        public static function getInstance() {
            if (!self::$instance) {
                self::$instance = new Database();
            }
            return self::$instance;
        }

        public function getConnection() {
            return $this->connection;
        }
}