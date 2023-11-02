<?php


require("../../modelo/tipo_producto.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["tipo_producto"])) {
        $nombreTipoProducto = $_POST["tipo_producto"];

        $tipo_producto = new TipoProducto();
        $resultado = $tipo_producto->agregarTipoProducto($nombreTipoProducto);

        echo "se agregó el tipo de producto: ".$resultado;
      
    } 

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_tipo_producto.html"); 
    die();

}


?>
