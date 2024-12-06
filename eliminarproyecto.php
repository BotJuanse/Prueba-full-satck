<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start(); 
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST
$idProyecto = $_POST['idProyecto'];
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// actualizar registro seleccionado
$eliminaproyecto=mysqli_query($conexion,"UPDATE proyectos SET estado_proyecto='inactivo' WHERE id_proyecto = '".$idProyecto."'");
// crear condicion para mensaje de respuesta
if ($eliminaproyecto) {
      $_SESSION['C'] = 'Qaz';
      header("Location: proyectos.php");
    }else{
      $_SESSION['C'] = 'Wer';
      header("Location: proyectos.php");
    }
?>