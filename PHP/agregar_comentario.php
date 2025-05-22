<?php
header('Content-Type: application/json');

require_once '../inc/conexion.php';
require_once '../inc/functions.php';

// Inicializar respuesta
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validar y limpiar datos
        $nombre = isset($_POST['nombre']) ? limpiar_cadena($_POST['nombre']) : null;
        $comentario = isset($_POST['comentario']) ? limpiar_cadena($_POST['comentario']) : null;
        $evaluacion = isset($_POST['evaluacion']) ? intval($_POST['evaluacion']) : null;
        $articulo_id = isset($_POST['articulo_id']) ? intval($_POST['articulo_id']) : null;
        $fecha = date('Y-m-d H:i:s');

        // Validaciones básicas
        if (empty($nombre)) {
            $response['errors']['nombre'] = 'El nombre es requerido';
        }
        
        if (empty($comentario)) {
            $response['errors']['comentario'] = 'El comentario es requerido';
        }
        
        if (!$evaluacion || $evaluacion < 1 || $evaluacion > 5) {
            $response['errors']['evaluacion'] = 'La evaluación debe ser entre 1 y 5';
        }
        
        if (!$articulo_id || $articulo_id <= 0) {
            $response['errors']['articulo_id'] = 'ID de artículo no válido';
        }

        // Si no hay errores, proceder con la inserción
        if (empty($response['errors'])) {
            $stmt_insertar = $conexion->prepare('INSERT INTO comentarios (fecha, nombre, comentario, evaluacion, articulo_id) VALUES (?, ?, ?, ?, ?)');
            
            if ($stmt_insertar) {
                $stmt_insertar->bind_param('sssii', $fecha, $nombre, $comentario, $evaluacion, $articulo_id);
                
                if ($stmt_insertar->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Comentario agregado exitosamente';
                } else {
                    $response['message'] = 'Error al ejecutar la consulta: ' . $stmt_insertar->error;
                }
                
                $stmt_insertar->close();
            } else {
                $response['message'] = 'Error al preparar la consulta: ' . $conexion->error;
            }
        } else {
            $response['message'] = 'Por favor corrige los errores en el formulario';
        }
    } catch (Exception $e) {
        $response['message'] = 'Error inesperado: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Método no permitido';
}

// Cerrar conexión y devolver respuesta
$conexion->close();
echo json_encode($response);
exit;













//-------------------------------------------------------------------------
/*require_once '../inc/conexion.php';
require_once '../inc/functions.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fecha = date('Y-m-d H:i:s');
    $nombre = limpiar_cadena($_POST['nombre']);
    $comentario = limpiar_cadena($_POST['comentario']);
    $evaluacion = $_POST['evaluacion'];
    $articulo_id= $_POST['articulo_id'];
    

    // Validar email
    $stmt_insertar = $conexion->prepare('INSERT INTO comentarios (fecha, nombre, comentario, evaluacion, articulo_id) VALUES (?, ?, ?, ?, ?)');
    $stmt_insertar->bind_param('ssssi', $fecha, $nombre, $comentario, $evaluacion, $articulo_id);

    if ($stmt_insertar->execute()) {
        $stmt_insertar->close();
    } else {
        echo 'Error al registrar: ' . $stmt_insertar->error;
    }

$conexion->close();
}*/