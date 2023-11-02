<?php


require("../../modelo/forma_pago.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["forma_pago"])) {
        $nombreForma_pago = $_POST["forma_pago"];

        $forma_pago = new FormaPago();
        $resultado = $forma_pago->agregarFormaPago($nombreForma_pago);

        echo "se agregó la forma de pago: ".$resultado;
      
    } 

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_forma_pago.html"); 
    die();

}


?>
