<?php


require("../../modelo/almacen.php");

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo 
	'
		<table class="table table-hover">
	    <tr>
	      <th scope="col">#ID</th>
	      <th scope="col">NOMBRE ALMACEN</th>
	    </tr>
	';
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para contalmacenar eventos

    if($opcion == 3)
	{
        $mi_busqueda = $_POST['mi_busqueda'];
		$almacen = new Almacen();
        $resultado = $almacen->buscarAlmacenNombre($mi_busqueda);
	  while($consulta = mysqli_fetch_array($resultado)) 
	  {
	    echo 
	    '
			<tr>
		      <td>'.$consulta['id_almacen'].'</td>
		      <td>'.$consulta['nombre'].'</td>
		    </tr>
	    ';
	  }	

	}
	else
	{
		if($opcion == 1)
        {
            $nombrealmacen = $_POST["nombre"];

            if($nombrealmacen != ""){
                
                $almacen = new Almacen();
                $resultado = $almacen->agregaralmacen($nombrealmacen);
                if($resultado > 0){
                echo "se agregó el almacen: ".$nombrealmacen;
                }        

            }
                
        }



		if($opcion == 2)
        {
                
            $almacen = new Almacen();
            $resultado = $almacen->listaralmacenes();
            //CONSULTAR
	        while($consulta = mysqli_fetch_array($resultado))
            {
                echo 
                '
                    <tr>
                    <td>'.$consulta['id_almacen'].'</td>
                    <td>'.$consulta['nombre'].'</td>
                    </tr>
                ';
            }	     

                            
        }


	  
	}

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_almacen.php"); 
    die();

}


?>
