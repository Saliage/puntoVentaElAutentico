<?php


require_once ("../modelo/carta.php");
// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    if ($opcion == "mostrar") {
        $tipo_producto = new Tipo_producto();
        $resultado = $tipo_producto->listarCat();
    
        
            echo '
                    <label for="tipo_producto">Categoria producto:</label>
                    <select id="tipo_producto" name="tipo_producto">
                '; 
            while ($consulta = mysqli_fetch_array($resultado)) {
                echo '<option value=' . $consulta['id_tipo'] . '>' . $consulta['nombre_tipo'] . '</option>';
            }
            echo '</select>';
    
    }
    else{

        echo 
        '
            <table class="table table-hover">
            <tr>
            <th scope="col">#Id</th>
            <th scope="col">Nombre</th>
            <th>Editar</ion-icon></th>
            <th>Eliminar</ion-icon></th> 
            </tr>
        ';
    
    }

    if($opcion == 3)
	{
        $mi_busqueda = $_POST['mi_busqueda'];
		$tipo_producto = new Tipo_producto();
        $resultado = $tipo_producto->buscarProductosNombre($mi_busqueda);
	  while($consulta = mysqli_fetch_array($resultado))
	  {
	    echo 
	    '
			<tr>
		      <td>'.$consulta['id_tipo'].'</td>
		      <td>'.$consulta['nombre_tipo'].'</td>
		    </tr>
	    ';
	  }	

	}
	else
	{
		if($opcion == 1)
        {
            $nombreTipo_producto = $_POST["nombre"];

            if($nombreTipo_producto != ""){
                
                $tipo_producto = new Tipo_producto();
                $resultado = $tipo_producto->agregarProductos($nombreTipo_producto);
                if($resultado > 0){
                echo "Se agregó la categoria: ".$nombreTipo_producto;
                }        

            }
                
        }



		if($opcion == 2)
        {
                
            $tipo_producto = new Tipo_producto();
            $resultado = $tipo_producto->listarCat();
            //CONSULTAR
	        while($consulta = mysqli_fetch_array($resultado))
            {
                echo 
                '
                    <tr>
                    <td>'.$consulta['id_tipo'].'</td>
                    <td>
                        <span  id="nombre_tipoSpan'.$consulta['id_tipo'].'">'.$consulta['nombre_tipo'].'</span>                        
                        <input style="display:none" type="text" id="nombre_tipoTxt'.$consulta['id_tipo'].'" value="'.$consulta['nombre_tipo'].'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon id="btnEdit'.$consulta['id_tipo'].'" name="pencil-outline" class="icono-editar" onclick="btnUserEdit('.$consulta['id_tipo'].')"></ion-icon>                        
                        <button style="display:none" id="guardarEdit'.$consulta['id_tipo'].'" onclick="guardarUsuarioEdit('.$consulta['id_tipo'].')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarProductos('.$consulta['id_tipo'].')"></ion-icon></td> 
                    </tr>
                ';
            }	     

                            
        }

        //editar

        if($opcion == "U")
        {
            $id_tipo_producto = $_POST["id"];
            $nombreTipo_producto = $_POST["nombre"];

            if($id_tipo_producto != ""){
                
                $tipo_producto = new Tipo_producto();
                $resultado = $tipo_producto->actualizarTipo_producto($id_tipo_producto, $nombreTipo_producto);
                if($resultado > 0){
                echo "Se actualizó la categoria: ".$nombreTipo_producto;
                }        

            }
                
        }

        
        

        // eliminar
        if($opcion == "D")
        {
            $id_tipo_producto = $_POST["id"];

            if($id_tipo_producto != ""){
                
                $tipo_producto = new Tipo_producto();
                try{

                    $resultado = $tipo_producto->eliminarRol($id_tipo_producto);
                    if($resultado > 0){
                    echo "se eliminó la categoria: ".$id_tipo_producto;
                    }

                }
                catch(Exception $e)
                {
                    echo "<script>alert('No sepuede eliminar la categoria: ".$id_tipo_producto."; Asegurese de que no esté asignado a un producto de la carta.');</script>";
                }        

            }
                
        }


	  
	}

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../carta-administrador.php"); 
    die();

}


?>
