<?php
require_once("../modelo/productos.php");
require_once ("../modelo/tipo_producto.php");


// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    //guardar
    if ($opcion == "listar") {

        $tipoProd = new TipoProducto();
        $resultado = $tipoProd->listarTiposProductos();
    
        echo '<select name="TipoProd" id="TipoProd" required>';
        echo '<option disabled selected hidden>--seleccionar--</option>';
    
        if ($resultado->num_rows > 0) {
            // Recorrer insumos presentes
            while ($dato = $resultado->fetch_assoc()) {
                echo '<option value="' . $dato['id_tipo'] . '" >' . $dato['nombre_tipo'] . '</option>';
            }
        } else {
            echo '<option value="0">NULL</option>';
        }
    
        echo '</select>';
    }        
    else{

        echo
            '
            <tr>
                <th>Id producto</th>
                <th>Nombre</th>
                <th>Codigo</th>
                <th>Imagen</th>
                <th>Costo unitario</th>
                <th>Precio venta</th>
                <th>Descripcion</th>
                <th>Disponible</th>
                <th>Editar</th> 
                <th>Elimnar</th> 
            </tr>
            
        ';
    }
        
    if ($opcion == "guardar") {   

        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $tipo   = $_POST['tipo'];
        $costo_u = $_POST['costo_u'];
        $precio_v = $_POST['precio_v'];
        $descripcion   = $_POST['descripcion'];
        $disponible = $_POST['disponible'];
    
        $ruta_imagen = "../../public/imagenes/NoImage.png"; //asiga una imagen fija

        if (isset($_FILES["imagen"])) {
            $imagen = $_FILES["imagen"];
            $nombre_imagen = $imagen["name"];
            $ruta_imagen = "../../public/imagenes/".$nombre_imagen;
    
            if (move_uploaded_file($imagen["tmp_name"], $ruta_imagen)) {
                echo "La imagen se ha subido correctamente a: ". $ruta_imagen;
            } else {
                $ruta_imagen = null;
                echo "Error al subir la imagen. ". $ruta_imagen;
            }
        } else {
            echo "Error: No se ha recibido la imagen. ".$ruta_imagen;
        }
        echo'<script>alert(tenemos: '.$nombre.'|'.$codigo.'|'.$ruta_imagen.'|'.$tipo.'|'.$costo_u.'|'.$precio_v.'|'.$descripcion.'|'.$disponible.');</script>';
        if ($nombre != "" && $tipo != "" && $costo_u != "" && $precio_v != "") {
            $productos = new Productos();
            try {
                $resultado = $productos->agregarProductos($nombre,$codigo,$ruta_imagen,$costo_u,$precio_v,$descripcion,$disponible,$tipo);
                if ($resultado > 0) {
                    echo "Se agregó el producto: ".$nombre;
                } else {
                    echo "No se pudo agregar el producto: ".$nombre;
                }
            } catch (Exception $e) {
                echo "Error, no se pudo guardar el producto: ".$e->getMessage();
            }
        }
    } 


    if($opcion == "mostrar")
	{
        $productos = new Productos();
        $resultado = $productos->listarProductos();        

	  while($consulta = mysqli_fetch_array($resultado))
	  {
        $icono = '<ion-icon name="ban-outline"></ion-icon>';
        $id = $consulta['id_producto'];
        $nombre = $consulta['nombre_producto'];
        $codigo = $consulta['codigo_producto'];
        $imagen   = $consulta['imagen'];
        $costo_u = $consulta['costo_unitario'];
        $precio_v = $consulta['precio_venta'];
        $descripcion   = $consulta['descripcion'];
        $disponible = $consulta['disponible'];

        if($disponible == 1){
            $icono = '<ion-icon name="checkmark-outline"></ion-icon>';
        }

       

	    echo 
	    '
            <tr>
                <td>'.$id.'</td>
                <td>    
                    <span  id="nombre_productoSpan'.$id.'">'.$nombre.'</span>                        
                    <input style="display:none" type="text" id="nombre_productoTxt'.$id.'" value="'.$nombre.'"> <!-- inicia oculto-->
                </td>
                <td>   
                    <span  id="codigo_productoSpan'.$id.'">'.$codigo.'</span>                        
                    <input style="display:none" type="text" id="codigo_productoTxt'.$id.'" value="'.$codigo.'"> <!-- inicia oculto-->
                </td>
                <td>   
                <img src="'.$imagen.'" id="imagenIMG'.$id.'" width="30" height="30">                       
                <input type="file" id="imagenINP'.$id.'" style="display:none" accept=".jpg, .jpeg, .png"><!-- inicia oculto-->
            </td>
                </td>
                <td>
                    <span  id="costo_unitarioSpan'.$id.'">'.$costo_u.'</span>
                    <input style="display:none" type="text" id="costo_unitarioTxt'.$id.'" value="'.$costo_u.'"> <!-- inicia oculto-->
                </td>
                <td>
                    <span id="precio_ventaSpan'.$id.'">'.$precio_v.'</span>
                    <input style="display:none" type="text" id="precio_ventaTxt'.$id.'" value="'.$precio_v.'"> <!-- inicia oculto-->
                </td>
                <td>
                    <span id="descripcionSpan'.$id.'" >'.$descripcion.'</span>
                    <input style="display:none" type="text" id="descripcionTxt'.$id.'" value="'.$descripcion.'"> <!-- inicia oculto-->
                </td>

                <td>
                <span id="disponibleSpan'. $id . '">' .$icono . '</span>
                <input type="checkbox" style="display:none" id="disponibleCHK'.$id .'" ' . ($disponible == 1 ? 'checked' : '') . '>
                 
                </td>
                <td>
                    <ion-icon id="btnproductoEdit'.$id.'" name="pencil-outline" class="icono-editar" onclick="editarProductos('.$id.')"></ion-icon>
                    <button style="display:none" id="guardarProductoEdit'.$id.'" onclick="guardarProductosEdit('.$id.')">OK</button> <!-- inicia oculto-->
                </td>
                <td>
                    <ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarProductos('.$id.')"></ion-icon>
                </td> 
            </tr><br>
	    ';
	  }	

	}

    

    //editar
    try {
        if ($opcion == "editar") {

            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $codigo = $_POST['codigo'];
            $costo_u = $_POST['costo_u'];
            $precio_v = $_POST['precio_v'];
            $descripcion = $_POST['descripcion'];
            $disponible = $_POST['disponible'];
            $ruta_imagen = $_POST['rutaImagen'];

            $id = intval($id); //asegurar que el id sea un entero

            if($codigo == ""){
                $codigo = null;
            }
           
            if (isset($_FILES["imagen"])) {
                $imagen = $_FILES["imagen"];
                $nombre_imagen = $imagen["name"];
                $ruta_imagen = "../../public/imagenes/".$nombre_imagen;
        
                if (move_uploaded_file($imagen["tmp_name"], $ruta_imagen)) {
                    echo "La imagen se ha subido correctamente a: ". $ruta_imagen;
                } else {
                    $ruta_imagen = null;
                    echo "Error al subir la imagen. ". $ruta_imagen;
                }
            } else {
                echo "Error: No se ha recibido la imagen. ".$ruta_imagen;
            }
            
            if ($nombre != "" && $costo_u != "" && $precio_v != "") {
                $productos = new Productos();
                try {
                    $resultado = $productos->actualizarProductos($id, $nombre, $codigo,$ruta_imagen,$costo_u,$precio_v,$descripcion,$disponible);
                    if ($resultado > 0) {
                        echo "Se agregó el producto: ".$nombre;
                    } else {
                        echo "No se pudo agregar el producto: ".$nombre;
                    }
                } catch (Exception $e) {
                    echo "Error, no se pudo guardar el producto: ".$e->getMessage();
                }
            }
        }



    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }


    // eliminar

    try {

        if($opcion == "eliminar")
        {
            $id = $_POST["id"];

            if($id != ""){
                
                $productos = new Productos();
                try{

                    $resultado = $productos->eliminarProductos($id);
                    if($resultado > 0){
                    echo "se eliminó el producto: ".$id;
                    }

                }
                catch(Exception $e)
                {
                    echo "<script>alert('No sepuede eliminar el producto: ".$id.".');</script>";
                }        

            }
                
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    
    
} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../carta-administrador.php"); 
    die();

}




?>
