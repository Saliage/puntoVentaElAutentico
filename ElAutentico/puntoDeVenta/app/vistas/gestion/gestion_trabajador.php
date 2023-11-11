<?php
require_once("../../modelo/trabajador.php");
require_once("../../modelo/rol.php");
// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    //guardar
        if($opcion == "guardar")
        {   
            $rut = $_POST['rut'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $estado = $_POST['estado'];
            $rol = $_POST['rol']; 

            $trabajador = new Trabajador();
            try{

                $resultado = $trabajador->agregarTrabajador($rut,$nombre,$apellido,$usuario,$clave,$estado,$rol);
                if($resultado > 0){
                echo "Se agregó al trabajador: ".$nombre." ".$apellido;
                }

            }
            catch(Exception $e)
            {
                echo "error inesperado?";
            }        

            
                
        }
        else{
            echo
            '
                <tr>
                    <th>Id usuario</th>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>apellido</th>
                    <th>Usuario</th>
                    <th>Clave</th>
                    <th>Estado</th>
                    <th>Tipo de usuario</th>
                    <th>Editar</th> 
                    <th>Elimnar</th> 
                </tr>
                
            ';
        }


    if($opcion == "mostrar")
	{
        $trabajador = new Trabajador();
        $resultado = $trabajador->listarTrabajadores();

        $rol = new Rol();
        $roles = $rol->listarRoles();
        $arrayRoles = array();
        //rellenar arrayRoles
        while ($cadaRol = $roles->fetch_assoc()) {
            $arrayRoles[] = $cadaRol;
        }

	  while($consulta = mysqli_fetch_array($resultado))
	  {
        $icono ='<ion-icon name="ban-outline"></ion-icon>';
        $id = $consulta['id_trabajador'];
        $rut = $consulta['rut'];
        $nombre = $consulta['nombre'];
        $apellido = $consulta['apellido'];
        $usuario = $consulta['usuario'];
        $clave = $consulta['clave'];
        $estado = $consulta['activo']; 
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
                    throw new Exception("Error al actualizar el usuario: " . $nombre);
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
