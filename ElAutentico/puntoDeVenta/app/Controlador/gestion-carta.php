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

    if ($opcion === 'guardar') {

        $nombrePromo = $_POST['nombrePromo'];
        $precioPromo = $_POST['precioPromo'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];
        $productos = json_decode($_POST['productos'], true);

        $promocion = new Promocion();
        $resultado = $promocion->agregarPromocion($nombrePromo, $precioPromo, $fechaInicio,$fechaFin,$productos);
      

        $respuesta = array('mensaje' => 'Promocion creada exitosamente');
        echo json_encode($respuesta);

    }

    if($opcion ==='mostrar'){

        echo
        '
            <tr>
                <th>Id Promoción</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Disponible</th>
                <th>Detalle</th>
            </tr>
        
        ';
        $promocion = new Promocion();
        $resultado = $promocion->listarPromociones();
        while($consulta = mysqli_fetch_array($resultado))
        {
            $id = $consulta['id_promocion'];
            $nombre = $consulta['nombre_promocion'];
            $precio = $consulta['precio'];
            $disponible = $consulta['disponible'];
    
            echo 
            '
                <tr>
                    <td>'.$id.'</td>
                    <td>    
                        <span  id="nombre_promocionSpan'.$id.'">'.$nombre.'</span>
                    </td>
                    <td>   
                        <span  id="precio_promocionSpan'.$id.'">'.$precio.'</span>
                    </td>
                    <td>
                        <input type="checkbox" id="disponibleCHK'.$id .'" ' . ($disponible === 1 ? 'checked' : '') . ' onclick="actualizarDisponible('.$id .')">                 
                    </td>
                    <td>
                        <details>
                            <summary>Detalles</summary>
                            <tr>
                                <td>
                                    crear una nueva fila
                                </td>
                            </tr>
                        </details>                    
                    </td>
                </tr><br>
            ';
        }	



    }






}
?>

