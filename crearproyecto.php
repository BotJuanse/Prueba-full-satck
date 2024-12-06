<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start();
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST y configurar fecha
$nombreProyecto = $_POST['nombreProyecto'];
$usuarioCreador = $_POST['usuarioCreador'];
$fechaActual = date("Y-m-d");
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// insertar el registro nuevo
 $creaproyecto=mysqli_query($conexion,"INSERT INTO proyectos(nombre_proyecto, usuario_creador, fecha_creacion, estado_proyecto) VALUES ('".$nombreProyecto."','".$usuarioCreador."','".$fechaActual."','activo')");
// crear condicion para mensaje de respuesta
if ($creaproyecto) {
      $_SESSION['A'] = 'Qaz';
      header("Location: proyectos.php");
    }else{
      $_SESSION['A'] = 'Wer';
      header("Location: proyectos.php");
    }
?>