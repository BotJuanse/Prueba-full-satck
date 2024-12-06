<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start(); 
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST y configurar fecha
$tituloTarea = $_POST['tituloTarea'];
$proyectoAsociado = $_POST['proyectoAsociado'];
$fechaFinalizacion = $_POST['fechaFinalizacion'];
$estadoTarea = $_POST['estadoTarea'];
$usuarioCreador = $_POST['usuarioCreador'];
$usuarioResponsable = $_POST['usuarioResponsable'];
$fechaActual = date("Y-m-d");
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// insertar el registro nuevo
$creatarea=mysqli_query($conexion,"INSERT INTO tareas(titulo, proyecto, fecha_finalizacion, estado_tarea, usuario_creador_tarea, usuario_responsable_tarea, fecha_creacion, estado_tarea_p) VALUES ('".$tituloTarea."','".$proyectoAsociado."','".$fechaFinalizacion."','".$estadoTarea."','".$usuarioCreador."','".$usuarioResponsable."','".$fechaActual."','activo')");
// crear condicion para mensaje de respuesta
if ($creatarea) {
      $_SESSION['A'] = 'Qaz';
      header("Location: tareas.php");
    }else{
      $_SESSION['A'] = 'Wer';
      header("Location: tareas.php");
    }
?>