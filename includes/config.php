<?php
class Conexion {
    private $host = "interchange.proxy.rlwy.net";  // HOST EXTERNO
    private $db   = "railway";
    private $user = "root";
    private $pass = "zQUPKAYMNRkdiPPBkDCKLqbpkCgIIAGw";
    private $port = 50622; // PUERTO EXTERNO

    public $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db};port={$this->port};charset=utf8",
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                    PDO::MYSQL_ATTR_SSL_CA => false
                ]
            );
        } catch (PDOException $e) {
            die(json_encode([
                "error" => "Error de conexión: " . $e->getMessage()
            ]));
        }
    }
}
