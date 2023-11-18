<?php
require_once ("../modelo/tipo_movimiento.php");

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $opcion = $_POST['opcion']; //obtener valor de la opción para contmovimeintoar eventos

    if ($opcion == "listar") {
        $movimeinto = new TipoMovimiento();
        $resultado = $movimeinto->listarTiposMovimiento();
    
        
            echo '
                    <label for="movimeinto">Tipo de Moviento:</label>
                    <select id="movimeinto" name="movimeinto">
                '; 
            while ($consulta = mysqli_fetch_array($resultado)) {
                echo '<option value=' . $consulta['id_tipo_mov'] . '>' . $consulta['nombre_tipo_mov'] . '</option>';
            }
            echo '</select>';
    
    }
    else{

        echo 
        '
            <table class="table table-hover">
            <tr>
            <th># ID</th>
            <th>NOMBRE MOVIEMIENTO</th>
            <th>EDITAR</th>
            <th>ELIMINAR</th> 
            </tr>
        ';
    
    }
		if($opcion == "guardar")
        {
            $nombremovimeinto = $_POST["nombre"];

            if($nombremovimeinto != ""){
                
                $movimeinto = new TipoMovimiento();
                $resultado = $movimeinto->agregarTipoMovimiento($nombremovimeinto);
                if($resultado > 0){
                echo "se agregó el movimeinto: ".$nombremovimeinto;
                }        

            }
                
        }



		if($opcion == "mostrar")
        {
                
            $movimeinto = new TipoMovimiento();
            $resultado = $movimeinto->listarTiposMovimiento();
            //CONSULTAR
	        while($consulta = mysqli_fetch_array($resultado))
            {
                echo 
                '
                    <tr>
                    <td>'.$consulta['id_tipo_mov'].'</td>
                    <td>
                        <span  id="nombre_movimeintoSpan'.$consulta['id_tipo_mov'].'">'.$consulta['nombre_tipo_mov'].'</span>                        
                        <input style="display:none" type="text" id="nombre_movimeintoTxt'.$consulta['id_tipo_mov'].'" value="'.$consulta['nombre_tipo_mov'].'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon id="btnEdit'.$consulta['id_tipo_mov'].'" name="pencil-outline" class="icono-editar" onclick="editarmovimeinto('.$consulta['id_tipo_mov'].')"></ion-icon>                        
                        <button style="display:none" id="guardarEdit'.$consulta['id_tipo_mov'].'" onclick="guardarmovimeintoEdit('.$consulta['id_tipo_mov'].')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarmovimeinto('.$consulta['id_tipo_mov'].')"></ion-icon></td> 
                    </tr>
                ';
            }	     

                            
        }

        //editar

        if($opcion == "U")
        {
            $id_movimeinto = $_POST["id"];
            $nombremovimeinto = $_POST["nombre"];

            if($id_movimeinto != ""){
                
                $movimeinto = new TipoMovimiento();
                $resultado = $movimeinto->actualizarmovimeinto($id_movimeinto, $nombremovimeinto);
                if($resultado > 0){
                echo "se actualizó el movimeinto: ".$nombremovimeinto;
                }        

            }
                
        }

        
        

        // eliminar
        if($opcion == "D")
        {
            $id_movimeinto = $_POST["id"];

            if($id_movimeinto != ""){
                
                $movimeinto = new TipoMovimiento();
                try{

                    $resultado = $movimeinto->eliminarmovimeinto($id_movimeinto);
                    if($resultado > 0){
                    echo "se eliminó el movimeinto: ".$id_movimeinto;
                    }

                }
                catch(Exception $e)
                {
                    echo "<script>alert('No sepuede eliminar el movimeinto: ".$id_movimeinto."; Asegurese de que no esté asignado a un trabajador.');</script>";
                }        

            }
                
        }


	  
	

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_trabajador.php"); 
    die();

}


?>
