<?php
require_once "../inc/conexion.php";
header('Content-Type: application/json');

$sql = "SELECT MONTH(fecha_salida) AS mes, COUNT(*) AS cantidad 
        FROM destinos 
        WHERE fecha_salida IS NOT NULL
        GROUP BY mes 
        ORDER BY mes";

$result = $conexion->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        'mes' => (int)$row['mes'],
        'cantidad' => (int)$row['cantidad']
    ];
}

echo json_encode($data);
?>