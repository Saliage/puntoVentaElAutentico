
<?php

require_once("../modelo/productos.php");
require_once("../modelo/tipo_producto.php");
require_once("../modelo/ventas.php");

session_start();
ob_start();

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    if($opcion =="ver" || $opcion == "buscar" || $opcion == "verXTipo"){

        $producto = new Productos();

        if($opcion =="buscar")
        {
            $busqueda = $_POST['busqueda'];
            $resultado = $producto->buscarProductosDisponibles($busqueda);
        }else{

            if($opcion == "verXTipo"){
                $idTipo = $_POST['idTipo'];
                $resultado = $producto->verDisponiblesXTipo($idTipo);

            }else{ $resultado = $producto->listarProductosDisponibles();}   
        }
        
        while($consulta = mysqli_fetch_array($resultado))
        {
            $id = $consulta['id_producto'];
            $nombre  = $consulta['nombre_producto'];
            $imagen = $consulta['imagen'];
            $precio = $consulta['precio_venta'];
            $descripcion = $consulta['descripcion'];

            echo'
            <div class="producto" data-id="' . $id . '" onclick="agregarAlCarrito(' . $id . ', \'' . $nombre . '\',' . (int)$precio . ');">
                <div class="imagen-producto">
                    <img src="'.$imagen.'" style="height: 80px">
                </div>
                <div class="informacion-producto">
                    <h3><strong>'.$nombre.'</strong></h3>
                    <div class="precio-container">
                        <p class="precio">$'.(int)$precio.'</p>
                    </div>
                </div>
            </div>


            ';
        }
    }

    //muestra categorías para ver productos de ese tipo
    if($opcion == "verCat"){

        $tipo_producto = new TipoProducto();
        $resultado = $tipo_producto->listarTiposProductos();
        while($consulta = mysqli_fetch_array($resultado))         
        {
            $id_tipo = $consulta['id_tipo'];
            $nombre_tipo = $consulta['nombre_tipo'];

            echo'
                <div class="item-categoria" onclick="verProdByCat('.$id_tipo.')">'.$nombre_tipo.'</div>
            ';
        }            
    }


    if($opcion == "procesarPago"){

        $formaPago = $_POST['formaPago'];
        $monto = $_POST['monto'];
        $operador = $_SESSION['id'];
        $carrito = json_decode($_POST['carrito'], true);

        $venta = new Ventas();
        $resultado = $venta->agregarVenta($monto,$operador,$formaPago, $carrito);

    }

    if($opcion == "verVentasVendedor"){

        $id_vendedor = $_POST['vendedor'];

        $venta = new Ventas();
        $resultado = $venta->listarVentasVendedor($id_vendedor);

        echo '
            <table class="table">
                <thead>
                    <tr class="container">
                        <th>Código Venta</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Forma de pago</th>
                        <th>Detalle</th> 
                    </tr>
                </thead>
                <tbody>

                ';
                while($consulta = mysqli_fetch_array($resultado)){

                    $id = $consulta['id'];
                    $fecha = $consulta['fecha'];
                    $monto = number_format($consulta['monto'], 0, ',', '.'); //dar formato al monto
                    $fPago = $consulta['fPago'];

                    echo '
                        <tr>
                            <td>'.$id.'</td>
                            <td>'.$fecha.'</td>
                            <td>$'.$monto.'</td>
                            <td>'.$fPago.'</td>
                            <td><ion-icon name="ellipsis-vertical-outline" class="icono-editar"></ion-icon></td>
                        </tr>                     
                    ';
                }
                echo'
            </tbody>
            </table>                    
        ';
    }

    if($opcion == "miBusqueda"){

        $id_vendedor = $_SESSION['id'];
        $buscar = $_POST['buscar'];

        $venta = new Ventas();
        $resultado = $venta->buscarMisVentas($buscar,$id_vendedor);

        echo '
            <table class="table">
                <thead>
                    <tr class="container">
                        <th>Código Venta</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Forma de pago</th>
                        <th>Detalle</th> 
                    </tr>
                </thead>
                <tbody>

                ';
                while($consulta = mysqli_fetch_array($resultado)){

                    $id = $consulta['id'];
                    $fecha = $consulta['fecha'];
                    $monto = number_format($consulta['monto'], 0, ',', '.'); //dar formato al monto
                    $fPago = $consulta['fPago'];

                    echo '
                        <tr>
                            <td>'.$id.'</td>
                            <td>'.$fecha.'</td>
                            <td>$'.$monto.'</td>
                            <td>'.$fPago.'</td>
                            <td><ion-icon name="ellipsis-vertical-outline" class="icono-editar"></ion-icon></td>
                        </tr>                     
                    ';
                }
                echo'
            </tbody>
            </table>                    
        ';
    }
    
    if($opcion == "verVentas"){

        $venta = new Ventas();
        $resultado = $venta->listarVentas();
        echo'
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id Venta</th>
                            <th>Nombre Vendedor</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Medio de pago</th>
                            <th>Detalle</th> 
                        </tr>
                    </thead>
                    <tbody>
            ';
                    while($consulta = mysqli_fetch_array($resultado)){
    
                        $id = $consulta['id'];
                        $vendedor = $consulta['nombre'];
                        $fecha = $consulta['fecha'];                        
                        $monto = number_format($consulta['monto'], 0, ',', '.'); //dar formato al monto
                        $fPago = $consulta['fPago'];
    
                        echo '
                            <tr>
                                <td>'.$id.'</td>
                                <td>'.$vendedor.'</td>
                                <td>'.$fecha.'</td>
                                <td>$'.$monto.'</td>
                                <td>'.$fPago.'</td>
                                <td><ion-icon name="ellipsis-vertical-outline" class="icono-editar"></ion-icon></td>
                            </tr>                     
                        ';
                    }
        echo'
                </tbody>
                </table>        
        ';
    }


    if($opcion == "busqueda"){

        $buscar = $_POST['buscar'];

        $venta = new Ventas();
        $resultado = $venta->buscarVentasTodos($buscar);
        echo'
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id Venta</th>
                            <th>Nombre Vendedor</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Medio de pago</th>
                            <th>Detalle</th> 
                        </tr>
                    </thead>
                    <tbody>
            ';
                    while($consulta = mysqli_fetch_array($resultado)){
    
                        $id = $consulta['id'];
                        $vendedor = $consulta['nombre'];
                        $fecha = $consulta['fecha'];                        
                        $monto = number_format($consulta['monto'], 0, ',', '.'); //dar formato al monto
                        $fPago = $consulta['fPago'];
    
                        echo '
                            <tr>
                                <td>'.$id.'</td>
                                <td>'.$vendedor.'</td>
                                <td>'.$fecha.'</td>
                                <td>$'.$monto.'</td>
                                <td>'.$fPago.'</td>
                                <td><ion-icon name="ellipsis-vertical-outline" class="icono-editar"></ion-icon></td>
                            </tr>                     
                        ';
                    }
        echo'
                </tbody>
                </table>        
        ';
    }
 
} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../usuarios-administrador.php"); 
    die();

}


?>
