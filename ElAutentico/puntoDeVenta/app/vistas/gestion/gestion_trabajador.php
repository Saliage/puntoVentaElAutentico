<?php
require("../../modelo/trabajador.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST["rut"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $activo = ($_POST['activo'] == 'True') ? 1 : 0; // 1 para Verdadero y  0 para Falso
    $rol_id = $_POST["rol_id"];

    // Llama al método agregarTrabajador con los datos del formulario
    $trabajador = new Trabajador();
    $resultado = $trabajador->agregarTrabajador($rut, $nombre, $apellido, $usuario, $clave, $activo, $rol_id);

    if ($resultado) {
        echo "Trabajador agregado exitosamente.";
    } else {
        echo "Error al agregar el trabajador.";
    }
}
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_trabajador.php"); 
    die();

}


?>
