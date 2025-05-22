<?php
require_once "../inc/conexion.php";
// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consultar la cantidad de registros por mes
$sql = "SELECT MONTH(fecha_registro) AS mes, COUNT(*) AS cantidad 
        FROM usuarios 
        WHERE YEAR(fecha_registro) = YEAR(CURDATE()) 
        GROUP BY MONTH(fecha_registro)";
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