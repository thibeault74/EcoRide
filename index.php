<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    include "./inc/head.php"; 
    require_once './inc/conexion.php';
    
?>

    
</head>

<body>
    <?php 
    include "./inc/NavBar.php";
    
    
  
$pagina = isset($_GET['p']) ? $_GET['p'] : 'main';

require_once 'vistas/' . $pagina . '.php'
    //if(isset($_SESSION['usuario_empresa'])) {
        /*echo $_SESSION['usuario_empresa'];
        echo $_SESSION['usuario_id'];*/

    //} else {
       // echo "La variable de sesión 'usuario_empresa' no está configurada.";
    //}
    
    ?>

</body>

</html>



