<?php
require("../../modelo/promocion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $fecha_fin = $_POST["fecha_fin"];


    // Llama al método agregarTrabajador con los datos del formulario
    $promocion = new Promocion();
    $resultado = $promocion->agregarPromocion($nombre, $precio, $fecha_inicio, $fecha_fin);

    if ($resultado) {
        echo "Promocion agregada exitosamente.";
    } else {
        echo "Error al agregar la promocion.";
    }
}
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_promocion.php"); 
    die();

}


?>
