<?php
class Conexion {
    private $host = "mysql.railway.internal";
    private $db   = "railway";
    private $user = "root";
    private $pass = "zQUPKAYMNRkdiPPBkDCKLqbpkCgIIAGw";
    private $port = 3306;

    public $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db};port={$this->port};charset=utf8",
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            die(json_encode([
                "error" => "Error de conexión: " . $e->getMessage()
            ]));
        }
    }
}
