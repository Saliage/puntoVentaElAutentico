<?php


require("../../modelo/rol.php");
// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo 
	'
		<table class="table table-hover">
	    <tr>
	      <th scope="col">#ID</th>
	      <th scope="col">NOMBRE ROL</th>
	    </tr>
	';
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    if($opcion == 3)
	{
        $mi_busqueda = $_POST['mi_busqueda'];
		$rol = new Rol();
        $resultado = $rol->buscarRolNombre($mi_busqueda);
	  while($consulta = mysqli_fetch_array($resultado))
	  {
	    echo 
	    '
			<tr>
		      <td>'.$consulta['id_rol'].'</td>
		      <td>'.$consulta['nombre_rol'].'</td>
		    </tr>
	    ';
	  }	

	}
	else
	{
		if($opcion == 1)
        {
            $nombreRol = $_POST["nombre"];

            if($nombreRol != ""){
                
                $rol = new Rol();
                $resultado = $rol->agregarRol($nombreRol);
                if($resultado > 0){
                echo "se agregó el rol: ".$nombreRol;
                }        

            }
                
        }



		if($opcion == 2)
        {
                
            $rol = new Rol();
            $resultado = $rol->listarRoles();
            //CONSULTAR
	        while($consulta = mysqli_fetch_array($resultado))
            {
                echo 
                '
                    <tr>
                    <td>'.$consulta['id_rol'].'</td>
                    <td>'.$consulta['nombre_rol'].'</td>
                    </tr>
                ';
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
