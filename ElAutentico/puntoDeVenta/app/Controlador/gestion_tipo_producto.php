<?php


require_once ("../modelo/tipo_producto.php");

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    echo 
    '
        <table class="table table-hover">
        <tr>
        <th scope="col">#ID</th>
        <th scope="col">NOMBRE CATEGORIA</th>
        <th>EDITAR</th>
        <th>ELIMINAR</th> 
        </tr>
    ';

		if($opcion === "guardar")
        {
            $nombreTipoProducto = $_POST["nombre"];

            if($nombreTipoProducto != ""){
                
                $tipo_producto = new TipoProducto();
                $resultado = $tipo_producto->agregarTipoProducto($nombreTipoProducto);
                if($resultado > 0){
                echo "Se agregó el tipo: ".$nombreTipoProducto;
                }     
            }
                
        }

        if($opcion === "mostrar"){
            $tipo_producto = new TipoProducto();
            $resultado = $tipo_producto->listarTiposProductos();
            while($consulta = mysqli_fetch_array($resultado))         
            {
                $id_tipo = $consulta['id_tipo'];
                $nombre_tipo = $consulta['nombre_tipo'];
    
                echo'
                    <tr>
                        <td>'.$id_tipo.'</td>
                        <td>
                            <span  id="nombre_tipoSpan'.$id_tipo.'">'.$nombre_tipo.'</span>                        
                            <input style="display:none" type="text" id="nombre_tipoTxt'.$id_tipo.'" value="'.$nombre_tipo.'"> <!-- inicia oculto-->
                        </td>
                        <td>
                            <ion-icon id="btnEditTipo'.$id_tipo.'" name="pencil-outline" class="icono-editar" onclick="editarTipoP('.$id_tipo.')"></ion-icon>                        
                            <button style="display:none" id="guardarTipoEdit'.$id_tipo.'" onclick="guardarTipoPEdit('.$id_tipo.')">OK</button> <!-- inicia oculto-->
                        </td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarTipoP('.$id_tipo.')"></ion-icon></td> 
                    </tr>
                ';
            }            
        }


        //editar

        if($opcion === "editar")
        {
            $id_tipo = $_POST["id"];
            $nombreTipoProducto = $_POST["nombre"];

            if($id_tipo != ""){
                
                try{
                    $tipo_producto = new TipoProducto();
                    $resultado = $tipo_producto->actualizarTipoProducto($id_tipo, $nombreTipoProducto);
                    if($resultado > 0){
                    echo "Se actualizó el tipo: ".$nombreTipoProducto;
                    }        
                }
                catch(Exception $e)
                {
                    echo "<script>alert('No se puede editar el tipo de producto: ".$e."');</script>";
                }        

            }
                
        }

        
        

        // eliminar
        if($opcion === "eliminar")
        {
            $id_tipo = $_POST["id"];

            if($id_tipo != ""){
                
                $tipo_producto = new TipoProducto();
                try{

                    $resultado = $tipo_producto->eliminarTipoProducto($id_tipo);
                    if($resultado > 0){
                    echo "Se eliminó la el tipo de producto: ".$id_tipo;
                    }

                }
                catch(Exception $e)
                {
                    echo "<script>alert('No se puede eliminar el tipo de producto: ".$id_tipo."; Asegurese de que no esté asignado a un producto.');</script>";
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
