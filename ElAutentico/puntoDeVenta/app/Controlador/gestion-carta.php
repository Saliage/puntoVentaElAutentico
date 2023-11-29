<?php 
require_once "../modelo/productos.php";


// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    //guardar
    if ($opcion == "listarProd") {



    }
    else{

        echo '
        
        
        
        ';

    }



















    }

?>