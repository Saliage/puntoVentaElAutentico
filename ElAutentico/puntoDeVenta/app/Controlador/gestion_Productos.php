<?php
require_once("../modelo/productos.php");
require_once("../modelo/cat.php");


// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    //guardar
        if($opcion == "guardar")
        {   
            $nombre_producto = $_POST['nombre_producto'];
            $codigo_producto = $_POST['codigo_producto'];
            $imagen = $_POST['imagen'];
            $costo_unitario = $_POST['costo_unitario'];
            $precio_venta = $_POST['precio_venta'];
            $descripcion = $_POST['descripcion'];
            $categorias = $_POST['categorias']; 

            if($nombre_producto != "" && $codigo_producto != "" && $imagen != "" && $costo_unitario != "" && $precio_venta != "" && $descripcion!= "" && $categorias != ""){

                $productos = new productos();
                try{

                    $resultado = $productos->agregarProductos($nombre_producto,$codigo_producto,$imagen,$costo_unitario,$precio_venta,$descripciono,$categorias);
                    if($resultado > 0){
                    echo "Se agregó se agrego el producto: ".$nombre_producto;
                    }

                }
                catch(Exception $e)
                {
                    echo "Error, no se puede guardar el producto, asegurese ".$nombre_producto." no se encuentre registrado";
                }     
            }   

            
                
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
