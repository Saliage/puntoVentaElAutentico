<?php

require_once("../modelo/zona.php");
require_once("../modelo/almacen.php");



// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para contalmacenar eventos

    //rellenar combobox con datos de almacenes
    if($opcion == 'cargarAlmacenes'){

        $almacen = new Almacen();
        $almacenes = $almacen->listarAlmacenes();
        echo'<select name="almacen_id" id="almacen_id" required>';
        echo '<option selected >-seleccionar-</option>';

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
    else{
        
        echo 
        '
        <table class="table">
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
        
    }
   

    if($opcion == 3)
	{
        $mi_busqueda = $_POST['mi_busqueda'];
		$zona = new zona();
        $resultado = $zona->buscarzonaNombre($mi_busqueda);
        
        $almacen = new Almacen();

	  while($consulta = mysqli_fetch_array($resultado)) 
	  {
        $consultaAlmacen = $almacen->buscarAlmacenId($consulta['almacen_id_almacen']);
        $nombreAlmacen = mysqli_fetch_assoc($consultaAlmacen);
	    echo 
	    '
			<tr>
		      <td>'.$consulta['id_zona'].'</td>
		      <td>'.$consulta['nombre_zona'].'</td>
              <td>'.$nombreAlmacen['nombre'].'</td>
		    </tr>
	    ';
	  }	

	}
	else
	{
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
            //CONSULTAR
	        $almacen = new Almacen();

            while($consulta = mysqli_fetch_array($resultado)) 
            {
                $consultaAlmacen = $almacen->buscarAlmacenId($consulta['almacen_id_almacen']);
                $nombreAlmacen = mysqli_fetch_assoc($consultaAlmacen);
                echo 
                '
                    <tr>
                        <td>'.$consulta['id_zona'].'</td>
                        <td>'.$consulta['nombre_zona'].'</td>
                        <td>'.$nombreAlmacen['nombre'].'</td>
                        <td><ion-icon name="pencil-outline" class="icono-editar"></ion-icon></td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                ';
            }		     

                            
        }	  
	}

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_zona.php"); 
    die();

}


?>
