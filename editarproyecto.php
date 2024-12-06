<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start(); 
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST y configurar fecha
$idProyecto = $_POST['idProyecto'];
$nombreProyecto = $_POST['nombreProyecto'];
$usuarioCreador = $_POST['usuarioCreador'];
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// actualizar registro seleccionado
 $editaproyecto=mysqli_query($conexion,"UPDATE proyectos SET nombre_proyecto='".$nombreProyecto."',usuario_creador='".$usuarioCreador."' WHERE id_proyecto = '".$idProyecto."'");
// crear condicion para mensaje de respuesta
if ($editaproyecto) {
      $_SESSION['B'] = 'Qaz';
      header("Location: proyectos.php");
    }else{
      $_SESSION['B'] = 'Wer';
      header("Location: proyectos.php");
    }
?>