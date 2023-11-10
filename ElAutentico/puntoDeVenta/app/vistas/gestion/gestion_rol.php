<?php


require_once ("../../modelo/rol.php");
// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    if ($opcion == "mostrar") {
        $rol = new Rol();
        $resultado = $rol->listarRoles();
    
        
            echo '
                    <label for="rol">Tipo de usuario:</label>
                    <select id="rol" name="rol">
                '; 
            while ($consulta = mysqli_fetch_array($resultado)) {
                echo '<option value=' . $consulta['id_rol'] . '>' . $consulta['nombre_rol'] . '</option>';
            }
            echo '</select>';
    
    }
    else{

        echo 
        '
            <table class="table table-hover">
            <tr>
            <th scope="col">#ID</th>
            <th scope="col">NOMBRE ROL</th>
            <th>EDITAR</ion-icon></th>
            <th>ELIMINAR</ion-icon></th> 
            </tr>
        ';
    
    }

    if($opcion == 3)
	{
        $mi_busqueda = $_POST['mi_busqueda'];
		$rol = new Rol();
        $resultado = $rol->buscarRolNombre($mi_busqueda);
	  while($consulta = mysqli_fetch_array($resultado))
	  {
	    echo 
	    '
			<tr>
		      <td>'.$consulta['id_rol'].'</td>
		      <td>'.$consulta['nombre_rol'].'</td>
		    </tr>
	    ';
	  }	

	}
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

        if($opcion == "U")
        {
            $id_rol = $_POST["id"];
            $nombreRol = $_POST["nombre"];

            if($id_rol != ""){
                
                $rol = new Rol();
                $resultado = $rol->actualizarRol($id_rol, $nombreRol);
                if($resultado > 0){
                echo "se actualizó el rol: ".$nombreRol;
                }        

            }
                
        }

        
        

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

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_trabajador.php"); 
    die();

}


?>
