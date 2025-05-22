<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

setlocale( LC_TIME, 'es', 'spa', 'es_ES' );
date_default_timezone_set( 'Australia/Sydney' );

session_start();

if (isset($_SESSION['usuario_id'])) {
    
    $usuario_id = $_SESSION['usuario_id'];
    $usuario_nombre = $_SESSION['usuario_nombre'];
    $usuario_apellidoPat = $_SESSION['usuario_apellidoPat'];
    $usuario_apellidoMat = $_SESSION['usuario_apellidoMat'];
    $usuario_dni = $_SESSION['usuario_dni'];
    $usuario_fechaNac = $_SESSION['usuario_fechaNac'];
    $usuario_empresa = $_SESSION['usuario_empresa'];
    $usuario_cargo = $_SESSION['usuario_cargo'];
    $usuario_sector = $_SESSION['usuario_sector'];
    $usuario_pais = $_SESSION['usuario_pais'];
    $usuario_email = $_SESSION['usuario_email'];
    $usuario_password = $_SESSION['usuario_password'];
    $usuario_level = $_SESSION['usuario_level'];
    
} else {
    
   // header('Location: http://localhost/login/inicio_sesion.php'); // Redirigir al inicio de sesión
    exit();
}
?>
