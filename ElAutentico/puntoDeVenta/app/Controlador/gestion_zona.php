<?php

require_once("../modelo/zona.php");
require_once("../modelo/almacen.php");

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para contalmacenar eventos


    
    echo 
    '
     <table class="table" style="width : 500px">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Almacen</th>
                <th>Editar</th>
                <th>Eliminar</th> 
            </tr>
                
        </thead>
    ';  
   

	if($opcion == "guardar")
    {
        $nombrezona = $_POST["nombre"];
        $almacenId = $_POST["almacen_id"];

        if($nombrezona != ""){
                
            $zona = new zona();
            $resultado = $zona->agregarzona($nombrezona,$almacenId);
            if($resultado > 0){
            echo "se agregó el zona: ".$nombrezona;
            }        

        }
                
    }

	if($opcion == "cargarZonas")
    {
                
        $zona = new zona();
        $resultado = $zona->listarZonas();
        //CONSULTAR Almacenes
	    $almacen = new Almacen();
        $almacenes = $almacen->listarAlmacenes();

        $arrayAlmacenes = array();
        //rellenar arrayAlmacenes
        while ($cadaAlmacen= $almacenes->fetch_assoc()) {
                $arrayAlmacenes[] = $cadaAlmacen;
        }

        while($consulta = mysqli_fetch_array($resultado)) 
        {
            $id_zona = $consulta['id_zona'];
            $nombreZona = $consulta['nombre_zona'];
            $idAlmacen = $consulta['almacen_id_almacen'];

            $consultaAlmacen = $almacen->buscarAlmacenId($idAlmacen); //busca alacen especifico
            $infoAlmacen = mysqli_fetch_assoc($consultaAlmacen); //rescata almacen de la consulta
            $nombreAlmacen = $infoAlmacen['nombre']; //almacena el nombre del almacen               
                
            echo 
            '
                <tr>
                    <td>'.$id_zona.'</td>
                    <td>
                        <span  id="nombre_zonaSpan'.$id_zona.'">'.$nombreZona.'</span>                        
                        <input style="display:none" type="text" id="nombre_zonaTxt'.$id_zona.'" value="'.$nombreZona.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <span  id="alcenSpan'.$id_zona.'">'.$nombreAlmacen.'</span>
                        <select id="almacenSelect'.$id_zona.'" style="display: none;">';

                        foreach ($arrayAlmacenes as $dato) {
                            echo '<option value="' . $dato['id_almacen'] . '" ' . ($dato['id_almacen'] == $idAlmacen ? 'selected' : '') . ' >' . $dato['nombre'] . '</option>';
                        }
                            
                        echo '</select>
                    </td>
                    <td>
                        <ion-icon id="btnEditZona'.$id_zona.'" name="pencil-outline" class="icono-editar" onclick="editarZona('.$id_zona.')"></ion-icon>                        
                        <button style="display:none" id="guardarEditZona'.$id_zona.'" onclick="guardarZonaEdit('.$id_zona.')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarZona('.$id_zona.')"></ion-icon></td> 
                </tr>
            ';
        }		     

                            
    }	  

    //EDITAR ZONA
    if($opcion == "editar")
    {
        $id_zona = $_POST["id"];
        $nombreZona = $_POST["nombre"];
        $almacen = $_POST["almacen"];

        if($id_zona != "" && $nombreZona !="" && $almacen !=""){
                
            $zona = new Zona();
            $resultado = $zona->actualizarZona($id_zona,$nombreZona,$almacen);
            if($resultado > 0){
            echo "se actualizó la zona: ".$nombrezona;
            }        

        }
                
    }

    //ELIMINAR ZONA
    if($opcion == "eliminar")
    {
        $id_zona = $_POST["id"];

        if($id_zona != ""){
            
            $zona = new Zona();
            try{

                $resultado = $zona->eliminarZona($id_zona);
                if($resultado > 0){
                echo "se eliminó la zona: ".$id_zona;
                }

            }
            catch(Exception $e)
            {
                echo "<script>alert('No sepuede eliminar la zona: ".$id_zona."; Asegurese de que no esté asigando a un insumo.');</script>";
            }        

        }
            
    }


  
}else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_zona.php"); 
    die();

}


?>
