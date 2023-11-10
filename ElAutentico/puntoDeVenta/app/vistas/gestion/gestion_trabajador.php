<?php
require_once("../../modelo/trabajador.php");
require_once("../../modelo/rol.php");
// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

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

    if($opcion == "mostrar")
	{
        $trabajador = new Trabajador();
        $resultado = $trabajador->listarTrabajadores();

        $rol = new Rol();
        $roles = $rol->listarRoles();
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

                    while ($dato = $roles->fetch_assoc()) {
                        echo '<option value="' . $dato['id_rol'] . '" '.($dato['id_rol'] == $consulta['rol_id_rol'] ? 'selected' : '').' >' . $dato['nombre_rol'] . '</option>';
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
    

    

	
    /*
    else
	{
		if($opcion == 1)
        {
            $nombreRol = $_POST["nombre"];

            if($nombreRol != ""){
                
                $rol = new Rol();
                $resultado = $rol->agregarRol($nombreRol);
                if($resultado > 0){
                echo "se agregó el rol: ".$nombreRol;
                }        

            }
                
        }



		if($opcion == 2)
        {
                
            $rol = new Rol();
            $resultado = $rol->listarRoles();
            //CONSULTAR
	        while($consulta = mysqli_fetch_array($resultado))
            {
                echo 
                '
                    <tr>
                    <td>'.$consulta['id_rol'].'</td>
                    <td>
                        <span  id="nombre_rolSpan'.$consulta['id_rol'].'">'.$consulta['nombre_rol'].'</span>                        
                        <input style="display:none" type="text" id="nombre_rolTxt'.$consulta['id_rol'].'" value="'.$consulta['nombre_rol'].'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon id="btnEdit'.$consulta['id_rol'].'" name="pencil-outline" class="icono-editar" onclick="editarRol('.$consulta['id_rol'].')"></ion-icon>                        
                        <button style="display:none" id="guardarEdit'.$consulta['id_rol'].'" onclick="guardarRolEdit('.$consulta['id_rol'].')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarRol('.$consulta['id_rol'].')"></ion-icon></td> 
                    </tr>
                ';
            }	     

                            
        }

        //editar

        

        // eliminar
        if($opcion == "D")
        {
            $id_rol = $_POST["id"];

            if($id_rol != ""){
                
                $rol = new Rol();
                try{

                    $resultado = $rol->eliminarRol($id_rol);
                    if($resultado > 0){
                    echo "se eliminó el rol: ".$id_rol;
                    }

                }
                catch(Exception $e)
                {
                    echo "<script>alert('No sepuede eliminar el rol: ".$id_rol."; Asegurese de que no esté asignado a un trabajador.');</script>";
                }        

            }
                
        }


	  
	}
    
    */

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../usuarios-administrador.php"); 
    die();

}


?>
