<?php
require_once("../modelo/inventario.php");
session_start();
ob_start();

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos
    
    if($opcion === "validar"){

        $perecible = $_POST["perecible"];

        if($perecible === 1){
            echo '
            <input type="date" id="fecha" name="fecha" min="'.date('Y-m-d').'" required>
            ';
        }
    }
    else{
        //preparar enunciado tablas        
        echo
        '
        <div class="container">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Formato</th>
                        <th>Perecible</th>
                        <th colspan="2">Detalles</th>
                    </tr>
                </thead>
                <tbody>
            
        ';
    }


   
    //guardar
    if($opcion === "guardar")
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
    if($opcion === "mostrar")
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
            
            if($perecible === 1)
            {
                $icono = '<ion-icon name="checkmark-outline"></ion-icon>';
            }

            echo 
            '
                <tr data-toggle="collapse" data-target="#detalles'.$id.'" class="accordion-toggle table-primary">
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
                    <td colspan="2">
                        <button class="btn btn-primary" title="Desplegar">
                            <ion-icon name="chevron-down-circle-outline"></ion-icon>
                        </button>
                    </td>

                </tr>
            ';

                echo'
                <tr id="detalles'.$id.'" class="collapse in table-secondary">
                    <td>#ID</td>
                    <td colspan="2">Nombre</td>
                    <td>Cantidad</td>
                    <td>Costo Unitario</td>
                    <td>Fecha Vencimiento</td>
                    <td>Almacen</td>
                    <td >Zona</td>
                    <td> </td>
                </tr>
                ';

                $detalles = $inventario->obtenerInsumosPorFecha($id);
                while($insumo = mysqli_fetch_array($detalles)){
                    
                    $nFormato = $formato;
                    $n_registro = $insumo['numero_registro'];
                    $id_insumo = $insumo['id_insumo'];
                    $nombre_insumo = $insumo['nombre_insumo'];
                    $cantidad = $insumo['cantidad'];
                    $costo_unitario = $insumo['costo_unitario'];
                    $fecha_vencimiento = $insumo['fecha_vencimiento'];
                    $nombre = $insumo['nombre'];
                    $nombre_zona = $insumo['nombre_zona']; 
                    echo'
                
                    <tr id="detalles'.$id.'" class="collapse in table-light">
                        <td>'.$id_insumo.'</td>
                        <td colspan="2">'.$nombre_insumo.'</td>
                        <td>'.$cantidad.'</td>
                        <td>'.$costo_unitario.'</td>
                        <td>'.$fecha_vencimiento.'</td>
                        <td>'.$nombre.'</td>
                        <td>'.$nombre_zona.'</td>
                        <td>
                        <button class="btn btn-danger" onclick="nuevaSalidaInsumo(\'' . $n_registro . '\', \'' . $id_insumo . '\', \'' . $nombre_insumo . '\', \'' .$nFormato . '\', \'' . $cantidad . '\')">Salida</button>
                        </td>
                    </tr>
                
                ';
            }

	    }	

	}
    // cerrar tabla generada.
    echo'
            </tbody>
        </table>
      </div>  
    ';

    if ($opcion === "salida") {

        $registro = $_POST["registro"];
        $insumo = $_POST["insumo"];
        $descontar = $_POST["descontar"];
    
        try {
            $inventario = new Inventario();
            $resultado = $inventario->salidaInventario($registro, $descontar, $insumo);
    
            if ($resultado) {
                echo 'Se rebajó el inventario';
            } else {
                echo 'Error al rebajar el inventario';
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
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
