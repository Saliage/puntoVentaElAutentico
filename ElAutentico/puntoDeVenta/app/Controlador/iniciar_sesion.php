<?php

require_once("../modelo/trabajador.php");
session_start();
ob_start();
$_SESSION['sesion'] = 0; // variable sin cambios, para rechazar todas las conexiones

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $trabajador = new Trabajador();
    $resultado = $trabajador->verificarTrabajador($usuario, $clave);

    $_SESSION['id'] = $row['id_trabajador'];
    $_SESSION['rol'] = $row['rol'];
    $_SESSION['usuario'] = $row['usuario'];
    $_SESSION['nombre'] = $row['nombre'];
    $_SESSION['apellido'] = $row['apellido'];
           
}
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: login.php"); 
    die();

}
?>