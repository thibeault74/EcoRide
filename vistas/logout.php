<?php
//session_start(); // Asegúrate de iniciar la sesión antes de cualquier salida

//require_once './inc/conexion.php'; // Asegura que el archivo se cargue correctamente

// Vaciar todas las variables de sesión
$_SESSION = array();

/*
// Destruir la cookie de sesión si está habilitada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
*/

session_destroy(); // Destruir la sesión

// Redirigir a la página de inicio de sesión
//header("Location: ./index.php?p=/main");
header("Location: http://localhost/ecoride/index.php?p=/main");
exit;
?>
