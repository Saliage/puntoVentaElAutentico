<?php
require_once("../modelo/insumo.php");
require_once("../modelo/categoria_insumo.php");
require_once("../modelo/formato.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion'];

    // Guardar
    if ($opcion == "guardar") {   
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $perecible = $_POST['perecible'];
        $formato = $_POST['formato'];
    
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
    
    
    if($opcion != "listar" && $opcion!="guardar"){

        echo
            '
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Perecible</th>
                <th>Categoria</th>                
                <th>Formato</th>
                <th>Editar</th> 
                <th>Elimnar</th> 
            </tr>
                
        ';
    }
            
    if ($opcion == "listar") {
        $insumo = new Insumo();
        $resultado = $insumo->listarInsumoFormato();
    
        echo '<select name="insumo" id="insumo" onchange="reqFecVen()" required>';
        echo '<option disabled selected hidden>--seleccionar--</option>';
    
        if ($resultado->num_rows > 0) {
            // Recorrer insumos presentes
            while ($dato = $resultado->fetch_assoc()) {
                echo '<option value="' . $dato['id_insumo'] . '" data-perecible="' . $dato['perecible'] . '">' . $dato['nombre_completo'] . '</option>';
            }
        } else {
            echo '<option value="0">NULL</option>';
        }
    
        echo '</select>';
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
            $icono = '<ion-icon name="close-outline"></ion-icon>'; //inicializa en no erecible ( X )

            $id = $consulta['id_insumo'];
            $imagen = $consulta['imagen'];
            $nombre = $consulta['nombre_insumo'];
            $perecible = $consulta['perecible'];
            $id_formato = $consulta['formato_id_formato'];
            $id_categoria = $consulta['categoria_insumo_id_categoria']; 
            $nombre_formato = mysqli_fetch_assoc($formato->buscarFormatoId($id_formato));
            $nombre_categoria = mysqli_fetch_assoc($categoria->buscarCategoriaInsumoId($id_categoria));
                
            if($perecible == 1)
            {
                $icono = '<ion-icon name="checkmark-outline"></ion-icon>';
            }

            echo 
            '
                <tr>
                    <td>'.$id.'</td>
                    <td>    
                    <img src="'.$imagen.'" id="imagenIMG'.$id.'" width="30" height="30">                       
                        <input type="file" id="imagenINP'.$id.'" style="display:none" accept=".jpg, .jpeg, .png"><!-- inicia oculto-->
                    </td>
                    <td>
                        <span  id="nombreSpanI'.$id.'">'.$nombre.'</span>
                        <input type="text" id="nombreTxtI'.$id.'" value="'.$nombre.'" style="display: none;">     
                    </td>
                    <td>   
                        <span  id="perecibleSpan'.$id.'">'.$icono.'</span>                        
                        <select id="perecibleSelect'.$id.'" style="display: none;">
                            <option value="0" '.($perecible == 0 ? 'selected' : '').' >No</option>
                            <option value="1" '.($perecible == 1 ? 'selected' : '').' >Si</option>                        
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
                        <button style="display:none" id="guardarInsumoEdit'.$id.'" onclick="guardarInsumoEdit('.$id.')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarInsumo('.$id.')"></ion-icon>
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

        //rescatar la ruta de la actual imagen si no fue editada
        $ruta_imagen = recortarRutaImagen( $_POST['ruta_imagen'] ); // formatea ruta de imagen para coincidir con "../../public/imagenes/nombre_imagen"

        if (isset($_FILES["imagen"])) {
            $imagen = $_FILES["imagen"];
            $nombre_imagen = $imagen["name"];
            $ruta_imagen = "../../public/imagenes/".$nombre_imagen; //si se recibe imagen, se actualiza la ruta
    
            if (move_uploaded_file($imagen["tmp_name"], $ruta_imagen)) {
                echo "La imagen se ha subido correctamente a: ". $ruta_imagen;
            } else {
                echo "Error al subir la imagen. ";
            }
        } else {
            echo "Error: No se ha recibido la imagen. ";
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


function recortarRutaImagen($ruta_completa_imagen) {
    // Buscar la posición de "public/imagenes/" en la ruta completa
    $posicion_inicio = strpos($ruta_completa_imagen, "public/imagenes/");

    // Verificar si se encontró la subcadena
    if ($posicion_inicio !== false) {
        // Recortar la parte de la ruta después de "public/imagenes/"
        $ruta_relacionada = substr($ruta_completa_imagen, $posicion_inicio);

        $ruta_final = "../../" . $ruta_relacionada;

        return $ruta_final;
    }

    return null;
}

?>
