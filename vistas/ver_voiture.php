<?php
require_once '../inc/conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT photo FROM voiture WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagen);

    if ($stmt->fetch()) {
        header("Content-Type: image/jpeg"); // cambia a image/png si corresponde
        echo $imagen;
    } else {
        // Imagen no encontrada
        http_response_code(404);
    }

    $stmt->close();
}
$conexion->close();
?>