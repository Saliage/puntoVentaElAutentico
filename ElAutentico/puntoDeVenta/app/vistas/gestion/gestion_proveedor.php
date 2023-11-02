<?php
require("../../modelo/proveedor.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_proveedor = $_POST["nombre_proveedor"];
    $rut_proveedor = $_POST["rut_proveedor"];
    $fono = $_POST["fono"];
    $mail = $_POST["mail"];
    $direccion = $_POST["direccion"];


    // Llama al método agregarProveedor con los datos del formulario
    $proveedor = new Proveedor();
    $resultado = $proveedor->agregarProveedor($nombre_proveedor, $rut_proveedor, $fono, $mail, $direccion);

    if ($resultado) {
        echo "Proveedor agregado exitosamente.";
    } else {
        echo "Error al agregar el proveedor.";
    }
}
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_proveedor.php"); 
    die();

}


?>
