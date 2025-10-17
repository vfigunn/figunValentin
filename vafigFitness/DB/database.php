<?php
class Database {
    private $host = "localhost";
    private $db_name = "gym";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function connect() {
        $this->pdo = null;
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ];
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch(PDOException $e) {
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
        return $this->pdo;
    }
}
