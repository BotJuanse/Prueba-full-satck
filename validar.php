<?php
// configurar zona horaria a bogotá
date_default_timezone_set('America/Bogota');
// iniciar las variables de sesion
session_start(); 
// incluir el archivo de conexion para realizar consultas a la BD
include "conexion.php";
// traer variables por metodo POST
$correo = $_POST['correo'];
$password = $_POST['password'];
// guardar variable de conexion en una variable local
$conexion=$_SESSION['conexion'];
// selecciona datos especificos de la BD
$validausuario=mysqli_query($conexion,"SELECT correo, password,nombre,id_usuario from usuarios where correo = '".$correo."'");
// guarda datos en variables independientes
while($f=mysqli_fetch_array($validausuario)){
            $usu=$f['correo'];
            $nombre=$f['nombre'];
            $id_usuario=$f['id_usuario'];
            $bcontrasena=base64_decode($f['password']);
        }
// realiza validaciones para garantizar que el usuario puede conectarse a la plataforma
if ($bcontrasena==$password) {
      session_start();
      $_SESSION["usunombre"] = $nombre;
      $_SESSION["usuid"] = $id_usuario;
      header("Location: home.php");
    }else{
      echo "<script> alert('datos incorrectos.'); window.location= 'index.php'</script>";
    }
?>