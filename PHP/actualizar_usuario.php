<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['id'])){
        
        require_once '../inc/conexion.php';
        require_once '../inc/functions.php';

        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidoPat = $_POST['apellidoPat'];
        $fechaNac = $_POST['fechaNac'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $photo = $_POST['photo'];
        $email = $_POST['email'];
        $level2 = $_POST['level2'];
        $confirmado = $_POST['confirmado'];
        $activo = $_POST['activo'];

        limpiar_cadena($nombre);
        limpiar_cadena($apellidoPat);
        limpiar_cadena($fechaNac);
        limpiar_cadena($telephone);
        limpiar_cadena($adresse);
        limpiar_cadena($photo);
        limpiar_cadena($email);
        limpiar_cadena($level2);
        limpiar_cadena($confirmado);
        limpiar_cadena($activo);
        
        $query = "UPDATE usuarios SET nombre=?, apellidoPat=?, fechaNac=?, telephone=?, adresse=?, photo=?, email=?, level2=?, confirmado=?, activo=? WHERE id=?";

        
        $stmt = $conexion->prepare($query);

        
        $stmt->bind_param("ssssssssssi", $nombre, $apellidoPat, $fechaNac, $telephone, $adresse, $photo, $email, $level2, $confirmado, $activo, $id);

        
        if ($stmt->execute()) {
            
            header('Location: index.php?p=/view_usuarios');
            exit;
        } else {
            
            echo "Erreur lors de la mise à jour de l'utilisateur.";
        }

        
        $conexion->close();
    } else {
        
        echo "Tous les champs sont obligatoires.";
    }
} else {
    
    header('Location: index.php?p=/view_usuarios');
    exit;
}
?>
