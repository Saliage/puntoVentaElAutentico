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
                <th>Categoria</th>
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
        if($codigo == ""){
            $codigo = 0; // si no se ingresa un codigo, se asiga 0
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
    
        if ($nombre != "" && $tipo != "" && $costo_u != "" && $precio_v != "") {
            $productos = new Productos();
            try {
                $resultado = $productos->agregarProductos($nombre,$codigo,$imagen,$costo_u,$precio_v,$descripcion,$disponible,$tipo);
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
        $productos = new productos();
        $resultado = $productos->listarProductos();

        $categorias = new Categorias();
        $categoriass = $categorias->listarCat();
        $arrayRoles = array();
        //rellenar arrayRoles
        while ($cadaCategorias = $Categoriass->fetch_assoc()) {
            $arrayCategoriass[] = $cadaCategorias;
        }

	  while($consulta = mysqli_fetch_array($resultado))
	  {
        $icono ='<ion-icon name="ban-outline"></ion-icon>';
        $id = $consulta['id_producto'];
        $nombre_producto = $consulta['nombre_producto'];
        $codigo_producto = $consulta['codigo_producto'];
        $imagen = $consulta['imagen'];
        $costo_unitario = $consulta['costo_unitario'];
        $precio_venta = $consulta['precio_venta'];
        $descripcion = $consulta['descripcion']; 
        $nombreCategorias = mysqli_fetch_assoc($categorias->buscarCatId($consulta['tipo_producto_id_tipo']));
        
        if($estado == 1)
        {
            $icono = '<ion-icon name="checkmark-outline"></ion-icon>';
        }

	    echo 
	    '
            <tr>
                <td>'.$id.'</td>
                <td>    
                    <span  id="nombre_productoSpan'.$id.'">'.$nombre_producto.'</span>                        
                    <input style="display:none" type="text" id="nombre_productoTxt'.$id.'" value="'.$nombre_producto.'"> <!-- inicia oculto-->
                </td>
                <td>   
                    <span  id="codigo_productoSpan'.$id.'">'.$codigo_producto.'</span>                        
                    <input style="display:none" type="text" id="codigo_productoTxt'.$id.'" value="'.$codigo_producto.'"> <!-- inicia oculto-->
                </td>
                <td>   
                    <span  id="imagenSpan'.$id.'">'.$imagen.'</span>                        
                    <input style="display:none" type="text" id="imagenTxt'.$id.'" value="'.$imagen.'"> <!-- inicia oculto-->
                </td>
                <td>
                    <span  id="costo_unitarioSpan'.$id.'">'.$costo_unitario.'</span>
                    <input style="display:none" type="text" id="costo_unitarioTxt'.$id.'" value="'.$costo_unitario.'"> <!-- inicia oculto-->
                </td>
                <td>
                    <span id="precio_ventaSpan'.$id.'" style="display: none;">'.$precio_venta.'</span>
                    <input style="display:none" type="text" id="precio_ventaTxt'.$id.'" value="'.$precio_venta.'"> <!-- inicia oculto-->
                </td>
                <td>
                    <span id="descripcionSpan'.$id.'" style="display: none;">'.$descripcion.'</span>
                    <input style="display:none" type="text" id="descripcionTxt'.$id.'" value="'.$descripcion.'"> <!-- inicia oculto-->
                </td>

                <td>
                    <span  id="categoriasSpan'.$id.'">'.$nombreCategorias['nombre_tipo'].'</span>
                    <select id="categoriasSelect'.$id.'" style="display: none;">';

                    foreach ($arrayCategoriass as $dato) {
                        echo '<option value="' . $dato['id_tipo'] . '" ' . ($dato['id_tipo'] == $consulta['tipo_producto_id_tipo'] ? 'selected' : '') . ' >' . $dato['nombre_tipo'] . '</option>';
                    }
                    
                    echo '</select>
                </td>
                <td>
                    <ion-icon id="btnproductoEdit'.$id.'" name="pencil-outline" class="icono-editar" onclick="editarProductos('.$id.')"></ion-icon>
                    <button style="display:none" id="guardarProductoEdit'.$id.'" onclick="guardarProductoEdit('.$id.')">OK</button> <!-- inicia oculto-->
                </td>
                <td>
                    <ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarProducto('.$id.')"></ion-icon>
                </td> 
            </tr><br>
	    ';
	  }	

	}

    //editar
    try {
        if ($opcion == "U") {
            $id = $_POST['id_producto'];
            $nombre_producto = $_POST['nombre_producto'];
            $codigo_producto = $_POST['codigo_producto'];
            $imagen = $_POST['imagen'];
            $costo_unitario = $_POST['costo_unitario'];
            $precio_venta = $_POST['precio_venta'];
            $descripcion = $_POST['descripcion'];
            $categorias = $_POST['tipo_producto'];
    
            if ($id != "") {
                $productos = new productos();
                $resultado = $productos->actualizaProductos($id, $nombre_producto, $codigo_producto, $imagen, $costo_unitario, $precio_venta, $descripcion, $categorias);
    
                if ($resultado > 0) {
                    echo "Se actualizó el producto: " . $nombre_producto;
                } else {
                    echo "Error, no se puede guardar el producto, revise los datos y asegurese que el producto: ".$nombre_producto." no se encuentre registrado";
                }
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }


    // eliminar

    try {

        if($opcion == "D")
        {
            $id = $_POST["id"];

            if($id != ""){
                
                $productos = new productos();
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
