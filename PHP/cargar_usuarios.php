<?php
require_once '../inc/conexion.php';

// Lógica para cargar usuarios
$result = $conexion->query('SELECT nombre, apellidoPat, apellidoMat, dni, fechaNac, empresa, cargo, sector, pais, email FROM usuarios');

// Mostrar la lista de usuarios en una tabla
echo '<table border="1">
        <tr>
            <th>Nombre</th>
            <th>apellidoPat</th>
            <th>apellidoMat</th>
            <th>dni</th>
            <th>fecha de Nacimiento</th>
            <th>empresa</th>
            <th>cargo</th>
            <th>sector</th>
            <th>pais</th>
            <th>email</th>
        </tr>';

while ($row = $result->fetch_assoc()) {
    echo '<tr>
            <td>' . $row['nombre'] . '</td>
            <td>' . $row['apellidoPat'] . '</td>
            <td>' . $row['apellidoMat'] . '</td>
            <td>' . $row['dni'] . '</td>
            <td>' . $row['fechaNac'] . '</td>
            <td>' . $row['empresa'] . '</td>
            <td>' . $row['cargo'] . '</td>
            <td>' . $row['sector'] . '</td>
            <td>' . $row['pais'] . '</td>
            <td>' . $row['email'] . '</td>
        </tr>';
}

echo '</table>';

$conexion->close();
?>

<!-- Contenedor para mostrar la lista de usuarios -->
<div id="usuariosList"></div>
