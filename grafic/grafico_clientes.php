<?php
require_once "../inc/conexion.php";

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
// Consultar datos
$sql = "SELECT confirmado, activo FROM usuarios";
$result = $conexion->query($sql);

// Crear un array para almacenar los datos
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Devolver los datos en formato JSON
echo json_encode($data);

// Cerrar conexión
$conexion->close();
?>