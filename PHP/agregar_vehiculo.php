<?php
require_once '../inc/conexion.php';
require_once '../inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario_id = $_POST['usuario_id'];
    $marca = limpiar_cadena($_POST['marca']);
    $modele = limpiar_cadena($_POST['modele']);
    $immatriculation = limpiar_cadena($_POST['immatriculation']);
    $couleur = limpiar_cadena($_POST['couleur']);
    $date_immatriculation = $_POST['date_immatriculation'];
    $energie = limpiar_cadena($_POST['energie']);
    $created_at = date('Y-m-d H:i:s');

    // Procesar foto si fue enviada
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $photoData = file_get_contents($_FILES['photo']['tmp_name']);
        $photoType = $_FILES['photo']['type'];
    } else {
        $photoData = null;
        $photoType = null;
    }

    // Verificar si la matrícula ya está registrada
    $stmt_verificar = $conexion->prepare('SELECT COUNT(*) FROM voiture WHERE immatriculation = ?');
    $stmt_verificar->bind_param('s', $immatriculation);
    $stmt_verificar->execute();
    $stmt_verificar->bind_result($num_filas);
    $stmt_verificar->fetch();
    $stmt_verificar->close();

    if ($num_filas > 0) {
        echo 'La matrícula ya está registrada.';
    } else {
        // Insertar nuevo vehículo
        $stmt_insertar = $conexion->prepare('
            INSERT INTO voiture (usuario_id, marca, modele, immatriculation, couleur, photo, date_immatriculation, energie, created_at, photoType) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        $stmt_insertar->bind_param('ssssssssss', $usuario_id, $marca, $modele, $immatriculation, $couleur, $photoData, $date_immatriculation, $energie, $created_at, $photoType);

        if ($stmt_insertar->execute()) {
            echo 'Vehículo registrado correctamente.';
        } else {
            echo 'Error al registrar el vehículo: ' . $stmt_insertar->error;
        };

        $stmt_insertar->close();
    }

    $conexion->close();
}
?>