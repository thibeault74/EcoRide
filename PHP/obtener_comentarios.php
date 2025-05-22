<?php
header('Content-Type: text/html; charset=UTF-8');

require_once '../inc/conexion.php';

// Validar y sanitizar el ID del artículo
$articulo_id = isset($_GET['articulo_id']) ? intval($_GET['articulo_id']) : 0;

if ($articulo_id <= 0) {
    echo '<p class="error-message">ID de artículo no válido</p>';
    exit;
}

try {
    // Consulta preparada para seguridad
    $sql = "SELECT id, nombre, comentario, evaluacion, fecha 
            FROM comentarios 
            WHERE articulo_id = ? 
            ORDER BY fecha DESC";
    
    $stmt = $conexion->prepare($sql);
    
    if (!$stmt) {
        throw new Exception('Error al preparar la consulta: ' . $conexion->error);
    }
    
    $stmt->bind_param("i", $articulo_id);
    
    if (!$stmt->execute()) {
        throw new Exception('Error al ejecutar la consulta: ' . $stmt->error);
    }
    
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        while ($comentario = $resultado->fetch_assoc()) {
            // Formatear la fecha para mejor legibilidad
            $fecha_formateada = date('d/m/Y H:i', strtotime($comentario['fecha']));
            
            echo '<div class="comentario-card">';
            echo '<div class="comentario-header">';
            echo '<strong>' . htmlspecialchars($comentario['nombre'], ENT_QUOTES, 'UTF-8') . '</strong>';
            echo '<span class="comentario-fecha">' . $fecha_formateada . '</span>';
            echo '</div>';
            
            echo '<div class="comentario-rating">';
            echo str_repeat('★', intval($comentario['evaluacion']));
            echo '</div>';
            
            echo '<p class="comentario-text">' . nl2br(htmlspecialchars($comentario['comentario'], ENT_QUOTES, 'UTF-8')) . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p class="sin-comentarios">No hay comentarios para este artículo. ¡Sé el primero en comentar!</p>';
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    error_log('Error en obtener_comentarios.php: ' . $e->getMessage());
    echo '<p class="error-message">Ocurrió un error al cargar los comentarios. Por favor intenta nuevamente.</p>';
} finally {
    $conexion->close();
}
?>