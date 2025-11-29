<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include("../../backend/includes/config.php");

$db = new Conexion();

try {
    $stmt = $db->pdo->query("
        SELECT 
            p.id,
            p.nombre,
            p.precio,
            p.descripcion,
            p.almacen,
            p.estado,
            (
                SELECT ip.url 
                FROM img_productos ip 
                WHERE ip.id_producto = p.id 
                LIMIT 1
            ) AS imagen
        FROM productos p
        WHERE p.estado = 1
    ");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al obtener productos: ' . $e->getMessage()]);
}
?>
