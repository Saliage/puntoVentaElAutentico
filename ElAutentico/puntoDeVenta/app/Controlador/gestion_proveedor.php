<?php
require_once("../modelo/proveedor.php");

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para contalmacenar eventos
            
    echo 
    '
        <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Rut</th>
                <th>Fono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Editar</th>
                <th>Eliminar</th> 
            </tr>
                
        </thead>
    ';

	//GUARDAR
    if($opcion == "guardar")
    {   
        $nombre = $_POST['nombre'];
        $rut = $_POST['rut'];
        $fono = $_POST['fono'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];

        if($rut != "" && $nombre != ""){

            $proveedor = new Proveedor();
            try{

                $resultado = $proveedor->agregarProveedor($nombre,$rut,$email,$email,$direccion);
                if($resultado > 0){
                echo "Se agregó al proveedor: ".$nombre;
                }

            }
            catch(Exception $e)
            {
                echo "Error, no se puede guardar al proveedor, asegurese que el rut: ".$rut." no se encuentre registrado";
            }     
        }              
    }

	if($opcion == "mostrar")
    {
	    $proveedor = new Proveedor();
        $resultado = $proveedor->listarProveedores();

        while($consulta = mysqli_fetch_array($resultado)) 
        {
            $id = $consulta['id_proveedor'];
            $nombre = $consulta['nombre_proveedor'];
            $rut = $consulta['rut_proveedor'];
            $fono = $consulta['fono'];
            $email = $consulta['mail'];
            $direccion = $consulta['direccion'];

            echo'
                <tr>
                    <td>'.$id.'</td>
                    <td>
                        <span  id="nombre_proveedorSpan'.$id.'">'.$nombre.'</span>                        
                        <input style="display:none" type="text" id="nombre_proveedorTxt'.$id.'" value="'.$nombre.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <span  id="rut_proveedorSpan'.$id.'">'.$rut.'</span>                        
                        <input style="display:none" type="text" id="rut_proveedorTxt'.$id.'" value="'.$rut.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <span  id="fono_proveedorSpan'.$id.'">'.$fono.'</span>                        
                        <input style="display:none" type="text" id="fono_proveedorTxt'.$id.'" value="'.$fono.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <span  id="email_proveedorSpan'.$id.'">'.$email.'</span>                        
                        <input style="display:none" type="text" id="email_proveedorTxt'.$id.'" value="'.$email.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <span  id="direccion_proveedorSpan'.$id.'">'.$direccion.'</span>                        
                        <input style="display:none" type="text" id="direccion_proveedorTxt'.$id.'" value="'.$direccion.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon id="btnEditproveedor'.$id.'" name="pencil-outline" class="icono-editar" onclick="editarProveedores('.$id.')"></ion-icon>                        
                        <button style="display:none" id="guardarEditproveedor'.$id.'" onclick="guardarProveedorEdit('.$id.')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarProveedor('.$id.')"></ion-icon></td> 
                </tr>
            ';
        }                            
    }	  

    //EDITAR
    if($opcion == "editar")
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $rut = $_POST['rut'];
        $fono = $_POST['fono'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];

        if($id != "" && $nombre !="" && $rut !=""){
                
            $proveedor = new Proveedor();
            $resultado = $proveedor->actualizarProveedor($id,$nombre,$rut,$fono,$email,$direccion);
            if($resultado > 0){
            echo "se actualizó al proveedor: ".$nombre;
            }        
        }                
    }

    //ELIMINAR
    if($opcion == "eliminar")
    {
        $id = $_POST['id'];

        if($id != ""){
            
            $proveedor = new Proveedor();
            try{

                $resultado = $proveedor->eliminarProveedor($id);
                if($resultado > 0){
                echo "se eliminó el proveedor: ".$id;
                }

            }
            catch(Exception $e)
            {
                echo "<script>alert('No sepuede eliminar al proveedor: ".$id."; Asegurese de que no esté en uso.');</script>";
            }        

        }
            
    }


  
}else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../vistas/login.php"); 
    die();

}


?>
