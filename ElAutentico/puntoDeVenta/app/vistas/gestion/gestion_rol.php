<?php


require("../../modelo/rol.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el campo de texto está presente en el formulario
    if (isset($_POST["textoInput"])) {
        // Obtener el valor del campo de texto
        $nombreRol = $_POST["textoInput"];

        $rol = new Rol();
        $resultado = $rol->agregarRol($nombreRol);

        echo "se agregó el rol: ".$resultado;
        
    } else {
        // El campo de texto no está presente en el formulario
        echo "Error: El campo de texto no está presente en el formulario.";
    }
} else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_trabajador.php"); 
    die();

}


?>