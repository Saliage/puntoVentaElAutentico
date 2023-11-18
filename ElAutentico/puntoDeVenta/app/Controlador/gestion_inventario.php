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

        if($fecha == null){echo 'fecha es null' ;}

        /*

        if($insumo != "" && $cantidad != "" && $costo != "" && $zona_id){

            $trabajador = new Trabajador();
            try{
                $resultado = $trabajador->agregarTrabajador($rut,$nombre,$apellido,$usuario,$clave,$estado,$rol);
                if($resultado > 0){
                echo "Se agregó al trabajador: ".$nombre." ".$apellido;
                }
            }
            catch(Exception $e)
            {
                echo "Error, no se puede guardar al trabajador, asegurese que el rut: ".$rut." no se encuentre registrado";
            }     
        } */
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
                    <span  id="apellidoSpan'.$id.'">'.$$stock.'</span>
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
                    <button class="boton-pagar2"  id="desplegarDetalle'.$id.'" onclick="deplegar"('.$id.')" title="Desplegar">
                    <ion-icon name="chevron-down-circle-outline"></ion-icon></button>
                    <button class="boton-pagar2"  id="ocultarDetalle'.$id.'" onclick="ocultar"('.$id.')" title="Ocultar">
                    <ion-icon name="chevron-up-circle-outline"></ion-icon></button> <!-- inicia oculto-->
                    </td>
            </tr> <div id="detalleStock'.$id.'"></div> <-- muestra el detalle de cada insumo -->
            <br>
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
