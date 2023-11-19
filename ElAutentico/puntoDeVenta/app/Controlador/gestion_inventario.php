<?php
require_once("../modelo/inventario.php");
session_start();
ob_start();

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos
    
    if($opcion == "validar"){

        $perecible = $_POST["perecible"];

        if($perecible == 1){
            echo '
            <input type="date" id="fecha" name="fecha" min="'.date('Y-m-d').'" required>
            ';
        }
    }
    else{
        //preparar enunciado tablas        
        echo
        '
            <tr>
                <th>#ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Categotía</th>
                <th>Formato</th>
                <th>Perecible</th>
                <th>Detalles</th>
            </tr>
            
        ';
    }


   
    //guardar
    if($opcion == "guardar")
    {   
        $insumo = $_POST["insumo"];
        $cantidad = $_POST["cantidad"];
        $costo = $_POST["costo"];
        $fecha = $_POST["fecha"];
        $zona_id = $_POST["zona_id"];
        $id_trabajador = $_SESSION['id']; //rescata id (variable global) del trabajador que tiene abierta la session
       

        if($insumo != "" && $cantidad != "" && $costo != "" && $zona_id){

            $inventario = new Inventario();
            try{
                $resultado = $inventario->agregarRegistro($insumo,$cantidad,$costo,$fecha,$zona_id,$id_trabajador);
                if($resultado > 0){
                echo "Se agregó al inventario un nuevo registro de entrada para el insumo: '$insumo'";
                }
            }
            catch(Exception $e)
            {
                echo "Error, no se puede guardar la entrada el inventario ".$e;
            }     
        } 
    }

    //muestra todo el contenido
    if($opcion == "mostrar")
	{
        $inventario = new Inventario();
        $resultado = $inventario->inventarioInnerJoin();
	    while($consulta = mysqli_fetch_array($resultado))
	    {

        $icono ='<ion-icon name="close-outline"></ion-icon>'; //perecible (X)
        $id = $consulta['id'];
        $imagen = $consulta['imagen'];
        $nombre = $consulta['nombre'];
        $stock = $consulta['stock_total'];
        $categoria = $consulta['categoria'];
        $formato = $consulta['formato'];
        $perecible = $consulta['perecible']; 
        
        if($perecible == 1)
        {
            $icono = '<ion-icon name="checkmark-outline"></ion-icon>';
        }

	    echo 
	    '
            <tr>
                <td>'.$id.'</td>
                <td>    
                    <img src="'.$imagen.'" id="imagen" width="40" height="40"></img>
                </td>
                <td>   
                    <span  id="nombreSpan'.$id.'">'.$nombre.'</span>
                </td>
                <td>   
                    <span  id="apellidoSpan'.$id.'">'.$stock.'</span>
                </td>
                <td>
                    <span  id="usuarioSpan'.$id.'">'.$categoria.'</span>
                </td>
                <td>
                    <span id="claveSpan'.$id.'">'.$formato.'</span>
                </td>
                <td>
                    <span id="estadoSpan'.$id.'">'.$icono.'</span>                   
                    </select>
                </td>
                <td>
                    <button  id="desplegarDetalle'.$id.'" onclick="deplegar('.$id.')" title="Desplegar">
                    <ion-icon name="chevron-down-circle-outline"></ion-icon></button>
                    <button  id="ocultarDetalle'.$id.'" onclick="ocultar('.$id.')" title="Ocultar" style="display : none">
                    <ion-icon name="chevron-up-circle-outline"></ion-icon></button> <!-- inicia oculto-->
                </td>

            </tr>
            <tr>
                <div id="detalleStock'.$id.'"></div> <-- muestra el detalle de cada insumo -->
            </tr> 
            <br>
	    ';
	  }	

	}


} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../usuarios-administrador.php"); 
    die();

}


?>
