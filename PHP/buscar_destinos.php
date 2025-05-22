<?php
include_once "../inc/conexion.php";
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$origen = isset($_POST['origen']) ? $_POST['origen'] : '';
$destino = isset($_POST['destino']) ? $_POST['destino'] : '';
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';

// Base de la consulta
$sql = "SELECT id, origen, destino, fecha_salida, hora_salida 
        FROM destinos";

// Filtros dinámicos
$filtros = [];
$params = [];
$types = [];

// Condiciones
if ($origen !== '') {
    $filtros[] = "origen LIKE ?";
    $types[] = 's';
    $params[] = '%' . $origen . '%';
}

if ($destino !== '') {
    $filtros[] = "destino LIKE ?";
    $types[] = 's';
    $params[] = '%' . $destino . '%';
}

if ($fecha !== '') {
    $filtros[] = "fecha_salida >= ?";
    $types[] = 's';
    $params[] = $fecha;
}

// Exclusión de estados
$filtros[] = "estado NOT IN ('completo', 'cancelado')";

// Agregar WHERE si hay filtros
if (!empty($filtros)) {
    $sql .= " WHERE " . implode(" AND ", $filtros);
}

// Opcional: ordenar por fecha y hora
$sql .= " ORDER BY fecha_salida ASC, hora_salida ASC";

$stmt = $conexion->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param(implode('', $types), ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$datos = [];
while ($row = $result->fetch_assoc()) {
    $datos[] = [
        'id' => $row['id'],
        'origen' => $row['origen'],
        'destino' => $row['destino'],
        'fecha_salida' => $row['fecha_salida'],
        'hora_salida' => $row['hora_salida']
    ];
}

header('Content-Type: application/json');
echo json_encode($datos);

$stmt->close();
$conexion->close();
?>