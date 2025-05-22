<?php
include_once "../inc/conexion.php";

$resultado = $conexion->query('SELECT * FROM usuarios ORDER BY id DESC');

while ($fila = $resultado->fetch_assoc()) {
    echo '<p><strong>Nombre:</strong> ' . $fila['nombre'] . ' | <strong>Edad:</strong> ' . $fila['edad'] . '</p>';
}

$conexion->close();
?>