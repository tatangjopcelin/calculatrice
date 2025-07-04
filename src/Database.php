<?php
class Database {
    private PDO $pdo;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'calculatrice-binaire'; 
        $user = 'root';
        $pass = '';

        $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }
}
