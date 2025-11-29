<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

include("../includes/config.php");

$db = new Conexion();

try {
    $stmt = $db->pdo->query("
        SELECT p.*,
            (SELECT ip.url FROM img_productos ip WHERE ip.id_producto = p.id LIMIT 1) AS imagen
        FROM productos p
        WHERE p.estado = 1
        ORDER BY p.id DESC
        LIMIT 10
    ");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al obtener destacados: ' . $e->getMessage()]);
}
