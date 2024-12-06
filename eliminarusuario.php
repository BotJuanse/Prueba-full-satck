<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start(); 
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST
$idUsuario = $_POST['idUsuario'];
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// actualizar registro seleccionado
$eliminausuario=mysqli_query($conexion,"UPDATE usuarios SET estado='inactivo' WHERE id_usuario = '".$idUsuario."'");
// crear condicion para mensaje de respuesta
if ($eliminausuario) {
      $_SESSION['C'] = 'Qaz';
      header("Location: usuarios.php");
    }else{
      $_SESSION['C'] = 'Wer';
      header("Location: usuarios.php");
    }
?>