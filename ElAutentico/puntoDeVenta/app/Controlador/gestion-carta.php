<?php 
require_once "../modelo/productos.php";
require_once "../modelo/promocion.php";


// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    //guardar
    if ($opcion === "listarProd") {

        $producto = new Productos();
        $resultado = $producto->listarProductos();

        echo '<select name="producto" id="selectProducto" required>';
        echo '<option disabled selected hidden>--seleccionar--</option>';
    
        if ($resultado->num_rows > 0) {
            // Recorrer productos presentes
            while ($dato = $resultado->fetch_assoc()) {
                echo '<option value="' . $dato['id_producto']. '">' . $dato['nombre_producto'] . '</option>';
            }
        } else {
            echo '<option value="0">NULL</option>';
        }
    
        echo '</select>';
        

    }
    else{

        echo '
        
        
        
        ';

    }

    if ($opcion === 'guardar') {

        $nombrePromo = $_POST['nombrePromo'];
        $precioPromo = $_POST['precioPromo'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];
        $productos = json_decode($_POST['productos'], true);

        $promocion = new Promocion();
        $resultado = $promocion->agregarPromocion($nombrePromo, $precioPromo, $fechaInicio,$fechaFin,$productos);
      

        $respuesta = array('mensaje' => 'Datos guardados exitosamente');
        echo json_encode($respuesta);

    }






}
?>

