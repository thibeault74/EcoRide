<?php
if (!isset($_GET["id"])) exit();
    
    $id = $_GET["id"];
    require_once './inc/conexion.php';

    // Preparar y ejecutar la consulta para eliminar
    $sentencia = $conexion->prepare("DELETE FROM usuarios WHERE id = ?;");
    $resultado = $sentencia->execute([$id]);
    if ($resultado === TRUE) {
        echo "<p class='message'>Registre supprimé avec succès</p>";
    } else {
        echo "<p class='message'>Erreur lors de la suppression de l'enregistrement</p>";
    }

?>
<link rel="stylesheet" href="./CSS/form.css">
<div class="containerE">
    <div class="buttonE">
        <a href="index.php?p=/view_usuarios" class="<?php echo ($pagina == 'view_usuarios' ? 'active' : ''); ?> button">Retour</a>
    </div>
</div>
