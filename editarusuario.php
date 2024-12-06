<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start(); 
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST y configurar fecha
$idUsuario = $_POST['idUsuario'];
$nombreUsuario = $_POST['nombreUsuario'];
$correoUsuario = $_POST['correoUsuario'];
$contrasenaUsuario = base64_encode($_POST['contrasenaUsuario']);
$rolUsuario = $_POST['rolUsuario'];
$fechaActual = date("Y-m-d");
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// actualizar registro seleccionado
$editausuario=mysqli_query($conexion,"UPDATE usuarios SET nombre='".$nombreUsuario."',correo='".$correoUsuario."',password='".$contrasenaUsuario."',rol='".$rolUsuario."', estado='activo' WHERE id_usuario = '".$idUsuario."'");
// crear condicion para mensaje de respuesta
if ($editausuario) {
      $_SESSION['B'] = 'Qaz';
      header("Location: usuarios.php");
    }else{
      $_SESSION['B'] = 'Wer';
      header("Location: usuarios.php");
    }
?>