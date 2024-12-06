<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start(); 
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST y configurar fecha
$nombreUsuario = $_POST['nombreUsuario'];
$correoUsuario = $_POST['correoUsuario'];
$contrasenaUsuario = base64_encode($_POST['contrasenaUsuario']);
$rolUsuario = $_POST['rolUsuario'];
$fechaActual = date("Y-m-d");
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// insertar el registro nuevo
$creausuario=mysqli_query($conexion,"INSERT INTO usuarios (nombre, correo, password, rol, fecha_creacion, estado) VALUES ('".$nombreUsuario."', '".$correoUsuario."', '".$contrasenaUsuario."', '".$rolUsuario."', '".$fechaActual."', 'activo');");
// crear condicion para mensaje de respuesta
if ($creausuario) {
      $_SESSION['A'] = 'Qaz';
      header("Location: usuarios.php");
    }else{
      $_SESSION['A'] = 'Wer';
      header("Location: usuarios.php");
    }
?>