<?php


require("../../modelo/formato.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["formato"])) {
        $nombreFormato = $_POST["formato"];

        $formato = new Formato();
        $resultado = $formato->agregarFormato($nombreFormato);

        echo "se agregó el formato: ".$resultado;
      
    } 

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_formato.html"); 
    die();

}


?>
