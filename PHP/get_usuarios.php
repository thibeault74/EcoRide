<?php
require_once '../inc/conexion.php';
header('Content-Type: application/json');

session_start(); // Asegúrate de iniciar la sesión para usar $_SESSION

// Verificar si el campo responsable fue proporcionado
if (!isset($_POST["responsable"]) || empty(trim($_POST["responsable"]))) {
    echo json_encode(["error" => "El campo 'responsable' no fue proporcionado o está vacío."]);
    exit;
}

// Obtener y procesar el campo
$responsable = trim($_POST["responsable"]) . '%'; // Agregar el comodín para el LIKE
$usuario_empresa = $_SESSION["usuario_empresa"] ?? null;

// Validar que usuario_empresa exista en la sesión
if (!$usuario_empresa) {
    echo json_encode(["error" => "La sesión no contiene el campo 'usuario_empresa'."]);
    exit;
}

// Preparar la consulta
$stmt = $conexion->prepare("
    SELECT id, nombre, apellidoPat 
    FROM usuarios 
    WHERE empresa = ? 
    AND (nombre LIKE ? OR apellidoPat LIKE ?)
");

// Verificar si la consulta se preparó correctamente
if ($stmt) {
    // Vincular los parámetros
    $stmt->bind_param("sss", $usuario_empresa, $responsable, $responsable);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->get_result();

    // Verificar si hay datos disponibles
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    } else {
        echo json_encode([]);
    }
} else {
    // Manejar errores en la preparación de la consulta
    echo json_encode(["error" => "Error en la consulta: " . $conexion->error]);
}
?>
