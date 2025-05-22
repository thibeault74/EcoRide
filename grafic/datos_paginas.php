<?php
require_once '../inc/conexion.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sqlPaginas = "SELECT pagina, COUNT(*) AS total FROM visitas GROUP BY pagina ORDER BY total DESC";
$resultPaginas = $conexion->query($sqlPaginas);

$paginas = [];
$visitas = [];

while ($row = $resultPaginas->fetch_assoc()) {
    $paginas[] = $row['pagina'];
    $visitas[] = $row['total'];
}

// Obtener visitas por país
$sqlPaises = "SELECT pais, COUNT(*) AS total FROM visitas GROUP BY pais ORDER BY total DESC";
$resultPaises = $conexion->query($sqlPaises);

$paises = [];
$visitasPaises = [];

while ($row = $resultPaises->fetch_assoc()) {
    $paises[] = $row['pais'];
    $visitasPaises[] = $row['total'];
}

// Retornar los datos en formato JSON
echo json_encode([
    "paginas" => $paginas, 
    "visitas" => $visitas, 
    "paises" => $paises, 
    "visitasPaises" => $visitasPaises
]);

$conexion->close();
?>
