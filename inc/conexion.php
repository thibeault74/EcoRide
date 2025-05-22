<?php
$hostname = 'localhost';
//$username = 'f247184_qhsefrance';
//$password = 'ThiMes87*';
//$database = 'f247184_integridaddb';
//$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ecoride';

$conexion = new mysqli($hostname, $username, $password, $database);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}
?>