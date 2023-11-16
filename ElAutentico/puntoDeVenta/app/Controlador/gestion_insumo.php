<?php
require_once("../modelo/insumo.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion'];

    // Guardar
    if ($opcion == "guardar") {   
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $perecible = $_POST['perecible'];
        $formato = $_POST['formato'];
    
        $ruta_imagen = null;
    
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
    
        if ($nombre != "" && $categoria != "" && $perecible != "" && $formato != "") {
            $insumo = new Insumo();
            try {
                $resultado = $insumo->agregarInsumo($nombre, $perecible, $ruta_imagen, $categoria, $formato);
                if ($resultado > 0) {
                    echo "Se agregó el insumo: ".$nombre;
                } else {
                    echo "No se pudo agregar el insumo: ".$nombre;
                }
            } catch (Exception $e) {
                echo "Error, no se pudo guardar el insumo: ".$e->getMessage();
            }
        }
    }   
    else{

        echo
            '
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Perecible</th>
                <th>Formato</th>
                <th>Editar</th> 
                <th>Elimnar</th> 
            </tr>
                
        ';
    }
            
        


    if($opcion == "mostrar")
	{
        //CONSULTAR CATEGORIAS
        $categoria = new CategoriaInsumo();
        $categorias = $categoria->listarCategoriasInsumo();
        $arrayCategoria[] =array();
	    
        while ($cadaCategoria= $categorias->fetch_assoc()) {
                $arrayCategoria[] = $cadaCategoria;
        }

        //CONSULTAR FORMATO
        $formato = new Formato();
        $formatos = $formato->listarFormatos();

        $arrayFormatos = array();
        //rellenar arrayAlmacenes
        while ($cadaFormato= $formatos->fetch_assoc()) {
                $arrayFormatos[] = $cadaFormato;
        }

        $insumo = new Insumo();
        $resultado = $insumo->listarInsumos();

        while($consulta = mysqli_fetch_array($resultado))
        {
            $id = $consulta['id_insumo'];
            $imagen = $consulta['imagen'];
            $nombre = $consulta['nombre_insumo'];
            $perecible = $consulta['perecible'];
            $id_formato = $consulta['$formato'];
            $id_categoria = $consulta['categoria']; 
            $nombre_formato = mysqli_fetch_assoc($formato->listarFormatos($id_formato));
            $nombre_categoria = mysqli_fetch_assoc($categoria->listarCategoriasInsumo($id_categoria));
                
            if($perecible == 1)
            {
                $icono = '<ion-icon name="checkmark-outline"></ion-icon>';
            }

            echo 
            '
                <tr>
                    <td>'.$id.'</td>
                    <td>    
                    <img src="'.$imagen.'" id="imagenIMG'.$id.'" width="500" height="600">                       
                        <input type="file" id="imagenINP'.$id.'" style="display:none" accept=".jpg, .jpeg, .png"><!-- inicia oculto-->
                    </td>
                    <td>   
                        <span  id="nombreSpanI'.$id.'">'.$nombre.'</span>                        
                        <select id="perecibleSelect'.$id.'" style="display: none;">
                            <option value="0" '.($estado == 0 ? 'selected' : '').' >No</option>
                            <option value="1" '.($estado == 1 ? 'selected' : '').' >Si</option>                        
                        </select>
                    </td>
                    <td>
                        <span  id="categoriaSpanI'.$id.'">'.$nombre_categoria['nombre_categoria'].'</span>
                        <select id="categoriaSelectI'.$id.'" style="display: none;">';
                        foreach ($arrayCategoria as $dato) {
                            echo '<option value="' . $dato['id_categoria'] . '" ' . ($dato['id_categoria'] == $id_categoria ? 'selected' : '') . ' >' . $dato['nombre_categoria'] . '</option>';
                        }                        
                        echo '</select>
                    </td>
                    <td>
                        <span  id="formatoSpanI'.$id.'">'.$nombre_formato['nombre_formato'].'</span>
                        <select id="formatoSelectI'.$id.'" style="display: none;">';
                        foreach ($arrayFormatos as $dato) {
                            echo '<option value="' . $dato['id_formato'] . '" ' . ($dato['id_formato'] == $id_formato ? 'selected' : '') . ' >' . $dato['nombre_formato'] . '</option>';
                        }                        
                        echo '</select>
                    </td>
                    <td>
                        <ion-icon id="btnInsumoEdit'.$id.'" name="pencil-outline" class="icono-editar" onclick="editarInsumo('.$id.')"></ion-icon>
                        <button id="guardarInsumoEdit'.$id.'"  style="display:none" onclick="guardarInsumoEdit('.$id.')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarUsuario('.$id.')"></ion-icon>
                    </td> 
                </tr>
            ';
	    }	

	}

    //editar
    if ($opcion == "editar") {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $perecible = $_POST['perecible'];
        $formato = $_POST['formato'];

        $ruta_imagen = null;

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

        if ($id != "" && $nombre != "" && $categoria != "" && $perecible != "" && $formato != "") {

            $insumo = new Insumo();
            try {
                $resultado = $insumo->actualizarInsumo($id,$nombre, $perecible, $ruta_imagen, $categoria, $formato);
                if ($resultado > 0) {
                    echo "Se actualizó el insumo: ".$nombre;
                } else {
                    echo "No se pudo actualizar el insumo: ".$nombre;
                }
            } catch (Exception $e) {
                echo "Error, no se pudo actualizar el insumo! ".$e->getMessage();
            }
        }
    }    

        

   


    // eliminar

    try {

        if($opcion == "eliminar")
        {
            $id = $_POST["id"];

            if($id != ""){
                
                $insumo = new Insumo();
                try{

                    $resultado = $insumo->eliminarInsumo($id);
                    if($resultado > 0){
                    echo "se eliminó el trabajador: ".$id;
                    }

                }
                catch(Exception $e)
                {
                    echo "<script>alert('No sepuede eliminar el insumo: ".$id.".');</script>";
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
    header("location: ../usuarios-administrador.php"); 
    die();

}


?>
