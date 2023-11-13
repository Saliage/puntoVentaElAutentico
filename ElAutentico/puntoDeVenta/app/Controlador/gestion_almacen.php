<?php
require_once("../modelo/almacen.php");



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
                <th>Editar</th>
                <th>Eliminar</th> 
            </tr>
                
        </thead>
    ';

	if($opcion == "guardar")
    {
        $nombreAlmacen = $_POST["nombre"];

        if($nombreAlmacen != ""){
                
            $almacen = new Almacen();
            $resultado = $almacen->agregarAlmacen($nombreAlmacen);
            if($resultado > 0){
            echo "se agregó el almacen: ".$nombreAlmacen;
            }        

        }
                
    }

	if($opcion == "mostar")
    {
	    $almacen = new Almacen();
        $resultado = $almacen->listarAlmacenes();

        while($consulta = mysqli_fetch_array($resultado)) 
        {
            $id_almacen = $consulta['id_almacen'];
            $nombreAlmacen = $consulta['nombre'];

            echo'
                <tr>
                    <td>'.$id_almacen.'</td>
                    <td>
                        <span  id="nombre_almacenSpan'.$id_almacen.'">'.$nombreAlmacen.'</span>                        
                        <input style="display:none" type="text" id="nombre_almacenTxt'.$id_almacen.'" value="'.$nombreAlmacen.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon id="btnEditAlmacen'.$id_almacen.'" name="pencil-outline" class="icono-editar" onclick="editarAlmacen('.$id_almacen.')"></ion-icon>                        
                        <button style="display:none" id="guardarEditAlmacen'.$id_almacen.'" onclick="guardarAlmacenEdit('.$id_almacen.')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarAlmacen('.$id_almacen.')"></ion-icon></td> 
                </tr>
            ';
        }                            
    }	  

    //EDITAR ALMACEN
    if($opcion == "editar")
    {
        $id_almacen= $_POST["id"];
        $nombreAlmacen = $_POST["nombre"];

        if($id_almacen != "" && $nombreAlmacen !=""){
                
            $almacen = new Almacen();
            $resultado = $almacen->actualizarAlmacen($id_almacen,$nombreAlmacen);
            if($resultado > 0){
            echo "se actualizó el almacen: ".$nombreAlmacen;
            }        
        }                
    }

    //ELIMINAR Almacen
    if($opcion == "eliminar")
    {
        $id_almacen= $_POST["id"];

        if($id_almacen != ""){
            
            $almacen = new Almacen();
            try{

                $resultado = $almacen->eliminarAlmacen($id_almacen);
                if($resultado > 0){
                echo "se eliminó el almacen: ".$id_almacen;
                }

            }
            catch(Exception $e)
            {
                echo "<script>alert('No sepuede eliminar el almacen: ".$id_almacen."; Asegurese de que no esté asigando a una zona.');</script>";
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
