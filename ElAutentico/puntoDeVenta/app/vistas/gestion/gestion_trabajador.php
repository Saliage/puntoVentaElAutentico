<?php

require("../../modelo/trabajador.php");

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para contalmacenar eventos

    $nombrezona = $_POST["nombre"];
    $almacenId = $_POST["almacen_id"];

    if($nombrezona != ""){
                
        $trabajador = new Trabajador();
        $resultado = $trabajador->agregarTrabajador();
            if($resultado > 0){
                echo "se agregó el zona: ".$nombrezona;
            }        

        }

   

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_zona.php"); 
    die();

}


?>
