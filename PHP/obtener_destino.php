<?php
include_once "../inc/conexion.php"; // tu archivo de conexión

$destino = $_POST['destino'] ?? '';

$stmt = $conexion->prepare("SELECT localidad FROM localidades WHERE localidad LIKE CONCAT('%', ?, '%') LIMIT 10");
$stmt->bind_param("s", $destino);
$stmt->execute();
$result = $stmt->get_result();

$localidades = [];
while ($row = $result->fetch_assoc()) {
    $localidades[] = $row;
}

echo json_encode($localidades);
?>
