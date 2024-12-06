<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start(); 
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST
$idtarea = $_POST['idtarea'];
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// actualizar registro seleccionado
$eliminatareas=mysqli_query($conexion,"UPDATE tareas SET estado_tarea_p='inactivo' WHERE id_tarea = '".$idtarea."'");
// crear condicion para mensaje de respuesta
if ($eliminatareas) {
      $_SESSION['C'] = 'Qaz';
      header("Location: tareas.php");
    }else{
      $_SESSION['C'] = 'Wer';
      header("Location: tareas.php");
    }
?>