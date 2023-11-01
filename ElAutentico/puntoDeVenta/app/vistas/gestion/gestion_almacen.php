<?php


require("../../modelo/almacen.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["almacen"])) {
        $nombreAlmacen = $_POST["almacen"];

        $almacen = new Almacen();
        $resultado = $almacen->agregarAlmacen($nombreAlmacen);

        echo "se agregó el almacen: ".$resultado;
      
    } 

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_almacen.html"); 
    die();

}


?>
