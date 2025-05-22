<?php
session_start();
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_POST['usuario_id'], $_POST['destinos_id'], $_POST['places_prendre'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit;
}

require_once '../inc/conexion.php';
$conexion->set_charset("utf8");

$usuario_id = (int)$_POST['usuario_id'];
$destinos_id = (int)$_POST['destinos_id'];
$places_prendre = (int)$_POST['places_prendre'];

// Obtener créditos actuales
$stmt = $conexion->prepare("SELECT credit FROM credi WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$credi = $result->fetch_assoc();
$credit = $credi['credit'] ?? 0;
$stmt->close();

// Obtener precio y lugares disponibles
$stmt = $conexion->prepare("SELECT precio, lugares_disponibles FROM destinos WHERE id = ?");
$stmt->bind_param("i", $destinos_id);
$stmt->execute();
$result = $stmt->get_result();
$destino = $result->fetch_assoc();
$stmt->close();

if (!$destino) {
    echo json_encode(['success' => false, 'message' => 'Trayecto no encontrado.']);
    exit;
}

$precio_total = $destino['precio'] * $places_prendre;

if ($places_prendre > $destino['lugares_disponibles']) {
    echo json_encode(['success' => false, 'message' => 'No hay suficientes lugares disponibles.']);
    exit;
}

if ($credit < $precio_total) {
    echo json_encode(['success' => false, 'message' => 'Créditos insuficientes.']);
    exit;
}

// Iniciar transacción
$conexion->begin_transaction();

try {
    // Restar créditos
    $stmt = $conexion->prepare("UPDATE credi SET credit = credit - ? WHERE usuario_id = ?");
    $stmt->bind_param("di", $precio_total, $usuario_id);
    $stmt->execute();
    $stmt->close();

    // Restar lugares disponibles
    $stmt = $conexion->prepare("UPDATE destinos SET lugares_disponibles = lugares_disponibles - ? WHERE id = ?");
    $stmt->bind_param("ii", $places_prendre, $destinos_id);
    $stmt->execute();
    $stmt->close();

    $conexion->commit();
    echo json_encode(['success' => true, 'message' => 'Trayecto reservado con éxito.']);
} catch (Exception $e) {
    $conexion->rollback();
    echo json_encode(['success' => false, 'message' => 'Error al procesar la reserva.']);
}
?>
