<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include("../includes/config.php");

$db = new Conexion();

try {

    if (!isset($_GET['id'])) {
        echo json_encode(['error' => 'ID no especificado']);
        exit;
    }

    $id = intval($_GET['id']);

    $stmt = $db->pdo->prepare("
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
        WHERE p.id = ? AND p.estado = 1
        LIMIT 1
    ");

    $stmt->execute([$id]);

    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo json_encode(['error' => 'Producto no encontrado']);
        exit;
    }

    echo json_encode($producto);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al obtener producto: ' . $e->getMessage()]);
}

