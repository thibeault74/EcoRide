<?php
require_once "../inc/conexion.php";
header('Content-Type: application/json');

$sql = "SELECT MONTH(date_in) AS mes, SUM(gains) AS cantidad 
        FROM gains 
        GROUP BY mes 
        ORDER BY mes";

$result = $conexion->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        'mes' => (int)$row['mes'],
        'cantidad' => (float)$row['cantidad']
    ];
}

echo json_encode($data);
?>