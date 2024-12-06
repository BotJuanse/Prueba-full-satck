<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start(); 
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST y configurar fecha
$fechaActual = date("Y-m-d");
$idTarea = $_POST['idTarea'];
$tituloTarea = $_POST['tituloTarea'];
$proyectoAsociado = $_POST['proyectoAsociado'];
$fechaFinalizacion = $_POST['fechaFinalizacion'];
$estadoTarea = $_POST['estadoTarea'];
$usuarioCreador = $_POST['usuarioCreador'];
$usuarioResponsable = $_POST['usuarioResponsable'];
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// actualizar registro seleccionado
$editatarea=mysqli_query($conexion,"UPDATE tareas SET titulo='".$tituloTarea."',proyecto='".$proyectoAsociado."',fecha_finalizacion='".$fechaFinalizacion."',estado_tarea='".$estadoTarea."',usuario_creador_tarea='".$usuarioCreador."',usuario_responsable_tarea='".$usuarioResponsable."' WHERE id_tarea = '".$idTarea."'");
// crear condicion para mensaje de respuesta
if ($editatarea) {
      $_SESSION['B'] = 'Qaz';
      header("Location: tareas.php");
    }else{
      $_SESSION['B'] = 'Wer';
      header("Location: tareas.php");
    }
?>