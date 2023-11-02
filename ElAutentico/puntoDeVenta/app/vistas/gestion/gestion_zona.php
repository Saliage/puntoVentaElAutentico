<?php
require("../../modelo/zona.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $almacen_id = $_POST["almacen_id"];

    // Llama al método agregarZona con los datos del formulario
    $zona = new Zona();
    $resultado = $zona->agregarZona($nombre, $almacen_id);

    if ($resultado) {
        echo "Zona agregada exitosamente.";
    } else {
        echo "Error al agregar la zona.";
    }
}
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_zona.php"); 
    die();

}


?>
