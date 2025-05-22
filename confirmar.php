<?php
require_once './inc/conexion.php';
$fecha_registro = date('Y-m-d');

function mostrarMensaje($tipo, $mensaje) {
    $color = $tipo === 'exito' ? '#d4edda' : '#f8d7da';
    $borde = $tipo === 'exito' ? '#c3e6cb' : '#f5c6cb';
    $texto = $tipo === 'exito' ? '#155724' : '#721c24';

    echo "
    <div style='
        background-color: $color;
        border: 1px solid $borde;
        color: $texto;
        padding: 15px;
        margin: 20px auto;
        max-width: 500px;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        text-align: center;
    '>
        $mensaje
    </div>";
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT id FROM usuarios WHERE token = ? AND confirmado = 0 AND activo = 0";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sqlUpdate = "UPDATE usuarios SET confirmado = 1, activo = 1, fecha_registro = $fecha_registro WHERE token = ?";
        $stmtUpdate = $conexion->prepare($sqlUpdate);
        $stmtUpdate->bind_param("s", $token);

        if ($stmtUpdate->execute()) {
            mostrarMensaje('exito', "✅ Votre compte a été confirmé. Maintenant tu peux <a href='https://www.qhsefrance.com/index.php?p=/inicio_sesion'>te connecter</a>.");
        } else {
            mostrarMensaje('error', "❌ Erreur lors de la confirmation de votre compte. Essayer à nouveau.");
        }
    } else {
        mostrarMensaje('error', "⚠️ Token non valide ou compte  a déjà été activé.");
    }
} else {
    mostrarMensaje('error', "⚠️ Aucun token n'a été fourni.");
}
?>
