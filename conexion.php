<?php
// Configuración de la base de datos
$host = "localhost";       
$user = "root";          
$password = "";   
$database = "prueba_tecnica";
// Crear la conexión
$conexion = mysqli_connect($host, $user, $password, $database);
// Crear variable de sesion de la conexion para usarla en las consultas
 $_SESSION["conexion"] = $conexion;
?>
