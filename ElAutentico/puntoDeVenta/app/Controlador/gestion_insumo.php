<?php
require_once("../modelo/insumos.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion'];

    // Guardar
    if ($opcion == "guardar") {   
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $perecible = $_POST['perecible'];
        $formato = $_POST['formato'];
        $costo = $_POST['costo'];
    
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
    
        if ($nombre != "" && $categoria != "" && $perecible != "" && $formato != "" && $costo != "") {
            $insumo = new Insumos();
            try {
                $resultado = $insumo->agregarInsumo($nombre, $perecible, $costo, $ruta_imagen, $categoria, $formato);
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
                <th>Perecible/th>
                <th>Formato</th>
                <th>Costo</th>
                <th>Editar</th> 
                <th>Elimnar</th> 
            </tr>
                
        ';
    }
            
        


    if($opcion == "mostrar")
	{
        $insumo = new Insumos();
        $resultado = $insumo->listarInsumos();

        //CONSULTAR CATEGORIAS
	    $almacen = new Almacen();
        $almacenes = $almacen->listarAlmacenes();

        $arrayAlmacenes = array();
        //rellenar arrayAlmacenes
        while ($cadaAlmacen= $almacenes->fetch_assoc()) {
                $arrayAlmacenes[] = $cadaAlmacen;
        }

        //CONSULTAR FORMATO
	    $almacen = new Almacen();
        $almacenes = $almacen->listarAlmacenes();

        $arrayAlmacenes = array();
        //rellenar arrayAlmacenes
        while ($cadaAlmacen= $almacenes->fetch_assoc()) {
                $arrayAlmacenes[] = $cadaAlmacen;
        }


        while($consulta = mysqli_fetch_array($resultado))
        {
            $id = $consulta['id_insumo'];
            $imagen = $consulta['imagen'];
            $nombre = $consulta['nombre_insumo'];
            $perecible = $consulta['perecible'];
            $formato = $consulta['$formato'];
            $costo = $consulta['costo'];
            $categoria = $consulta['categoria']; 
            $nombreRol = mysqli_fetch_assoc($rol->buscarRolId($consulta['rol_id_rol']));
                
            if($estado == 1)
            {
                $icono = '<ion-icon name="checkmark-outline"></ion-icon>';
            }

            echo 
            '
                <tr>
                    <td>'.$id.'</td>
                    <td>    
                        <span  id="rutSpan'.$id.'">'.$rut.'</span>                        
                        <input style="display:none" type="text" id="rutTxt'.$id.'" value="'.$rut.'"> <!-- inicia oculto-->
                    </td>
                    <td>   
                        <span  id="nombreSpan'.$id.'">'.$nombre.'</span>                        
                        <input style="display:none" type="text" id="nombreTxt'.$id.'" value="'.$nombre.'"> <!-- inicia oculto-->
                    </td>
                    <td>   
                        <span  id="apellidoSpan'.$id.'">'.$apellido.'</span>                        
                        <input style="display:none" type="text" id="apellidoTxt'.$id.'" value="'.$apellido.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <span  id="usuarioSpan'.$id.'">'.$usuario.'</span>
                        <input style="display:none" type="text" id="usuarioTxt'.$id.'" value="'.$usuario.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <span id="claveSpan'.$id.'" style="display: none;">'.$clave.'</span>
                        <input style="display:none" type="text" id="claveTxt'.$id.'" value="'.$clave.'"> <!-- inicia oculto-->
                        <button id="verClave'.$id.'"  onclick="mostrarClave('.$id.')"><ion-icon id="ver'.$id.'" name="eye-outline"></ion-icon></button>
                    </td>
                    <td>
                        <span id="estadoSpan'.$id.'">'.$icono.'</span>
                        <select id="estadoSelect'.$id.'" style="display: none;">
                            <option value="0" '.($estado == 0 ? 'selected' : '').' >Deshabilitado</option>
                            <option value="1" '.($estado == 1 ? 'selected' : '').' >Habilitado</option>                        
                        </select>
                    </td>
                    <td>
                        <span  id="rolSpan'.$id.'">'.$nombreRol['nombre_rol'].'</span>
                        <select id="rolSelect'.$id.'" style="display: none;">';

                        foreach ($arrayRoles as $dato) {
                            echo '<option value="' . $dato['id_rol'] . '" ' . ($dato['id_rol'] == $consulta['rol_id_rol'] ? 'selected' : '') . ' >' . $dato['nombre_rol'] . '</option>';
                        }
                        
                        echo '</select>
                    </td>
                    <td>
                        <ion-icon id="btnUserEdit'.$id.'" name="pencil-outline" class="icono-editar" onclick="editarUsuario('.$id.')"></ion-icon>
                        <button style="display:none" id="guardarUsuarioEdit'.$id.'" onclick="guardarUsuarioEdit('.$id.')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarUsuario('.$id.')"></ion-icon>
                    </td> 
                </tr>
            ';
	    }	

	}

    //editar
    try {
        if ($opcion == "U") {
            $id = $_POST['id'];
            $rut = $_POST['rut'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $estado = $_POST['estado'];
            $rol = $_POST['rol'];
    
            if ($id != "") {
                $trabajador = new Trabajador();
                $resultado = $trabajador->actualizarTrabajador($id, $rut, $nombre, $apellido, $usuario, $clave, $estado, $rol);
    
                if ($resultado > 0) {
                    echo "Se actualizó el usuario: " . $nombre;
                } else {
                    echo "Error, no se puede guardar al trabajador, revise los datos y asegurese que el rut: ".$rut." no se encuentre registrado";
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
                
                $trabajador = new Trabajador();
                try{

                    $resultado = $trabajador->eliminarTrabajador($id);
                    if($resultado > 0){
                    echo "se eliminó el trabajador: ".$id;
                    }

                }
                catch(Exception $e)
                {
                    echo "<script>alert('No sepuede eliminar al trabajador: ".$id.".');</script>";
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
