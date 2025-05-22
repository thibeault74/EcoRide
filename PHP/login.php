<?php
session_start();
require_once '../inc/conexion.php';
require_once '../inc/functions.php';

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        limpiar_cadena($email);
        limpiar_cadena($password);
        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND confirmado = 1 AND activo = 1";
        $result = $conexion->query($sql);
        if ($result) {
            if ($result->num_rows == 1) {
                if ($row = $result->fetch_assoc()) {
                    if (password_verify($password, $row['password1'])) {
                        $_SESSION['usuario_id'] = $row['id'];
                        $_SESSION['usuario_nombre'] = $row['nombre'];
                        $_SESSION['usuario_apellidoPat'] = $row['apellidoPat'];
                        $_SESSION['usuario_telephone'] = $row['telephone'];
                        $_SESSION['usuario_adresse'] = $row['adresse'];
                        $_SESSION['usuario_fechaNac'] = $row['fechaNac'];
                        $_SESSION['usuario_photo'] = $row['photo'];
                        $_SESSION['usuario_photo_type'] = $row['photo_type'];
                        $_SESSION['usuario_email'] = $row['email'];
                        $_SESSION['usuario_password'] = $row['password1'];
                        $_SESSION['usuario_level'] = $row['level2'];
                        
                        echo "Inicio de sesión exitoso";
                        
                        exit();
                    } else {
                        echo "Existe un error, su cuenta no esta cofirmada, o no esta activa, o su clave es incorrecta";
                        
                        exit();
                    }
                }
            }
        }
    }
    ?>








