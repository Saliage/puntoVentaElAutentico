<?php
require_once("../modelo/almacen.php");



// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para contalmacenar eventos
    if($opcion != "ver" && $opcion != "listar2" ){
        echo 
        '
            <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Sala de venta</th>
                    <th>Editar</th>
                    <th>Eliminar</th> 
                </tr>
                    
            </thead>
        ';
    }

        //crear select-option con almacenes    
        if($opcion == 'ver'){

        
            $almacen = new Almacen();
            $almacenes = $almacen->listarAlmacenes();
            echo'<select name="almacen_id" id="almacen_id" required>';
            echo '<option selected >--seleccionar--</option>';
        
            if ($almacenes->num_rows > 0) {
                // Recorrer almacenes presentes
                while ($dato = $almacenes->fetch_assoc()) {
                    echo '<option value="' . $dato['id_almacen'] . '">' . $dato['nombre'] . '</option>';
                }
            } else {
                echo '<option value="0">NULL</option>';
            }
        
            echo'</select>';
        
        }

    // incrustar evento JS para trabajar en la vista
    if($opcion == 'listar2'){

        $almacen = new Almacen();
        $almacenes = $almacen->listarAlmacenes();
        
        echo'<select name="almacen_id2" id="almacen_id2" onchange="mostrarZonasAlmacen()" required>';
        echo '<option selected >--seleccionar--</option>';
    
        if ($almacenes->num_rows > 0) {
            // Recorrer almacenes presentes
            while ($dato = $almacenes->fetch_assoc()) {
                echo '<option value="' . $dato['id_almacen'] . '">' . $dato['nombre'] . '</option>';
            }
        } else {
            echo '<option value="0">NULL</option>';
        }
    
        echo'</select>';
    
    }



	if($opcion == "guardar")
    {
        $nombreAlmacen = $_POST["nombre"];
        $sala_venta = $_POST["sala_venta"];

        echo'sala venta tiene:['.$sala_venta.']';

        if($nombreAlmacen != ""){
                
            $almacen = new Almacen();
            $resultado = $almacen->agregarAlmacen($nombreAlmacen , $sala_venta);
            if($resultado > 0){
            echo "se agregó el almacen: ".$nombreAlmacen;
            }        

        }
                
    }

	if($opcion == "mostrar")
    {
	    $almacen = new Almacen();
        $resultado = $almacen->listarAlmacenes();
        while($consulta = mysqli_fetch_array($resultado)) 
        {
            $id_almacen = $consulta['id_almacen'];
            $nombreAlmacen = $consulta['nombre'];
            $sala_venta = $consulta['sala_venta'];

            $icono = '<ion-icon name="close-outline"></ion-icon>';

            if($sala_venta == 1)
            {
                $icono = '<ion-icon name="checkmark-outline"></ion-icon>';
            }

            echo'
                <tr>
                    <td>'.$id_almacen.'</td>
                    <td>
                        <span  id="nombre_almacenSpan'.$id_almacen.'">'.$nombreAlmacen.'</span>                      
                        <input style="display:none" type="text" id="nombre_almacenTxt'.$id_almacen.'" value="'.$nombreAlmacen.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <span id="sala_ventaSpan'.$id_almacen.'">'.$icono.'</span>
                        <input type="checkbox" id="sala_ventachk'.$id_almacen.'" '. ($sala_venta == 1 ? 'checked' : '').' style="display:none" >
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
        $sala_venta = $consulta['sala_venta'];

        if($id_almacen != "" && $nombreAlmacen !=""){
                
            $almacen = new Almacen();
            $resultado = $almacen->actualizarAlmacen($id_almacen,$nombreAlmacen,$sala_venta);
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
