<?php
require_once("../modelo/formato.php");

// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos
    
    if($opcion != 'listar'){
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
    }

	if($opcion === "guardar")
    {
        $nombre_formato = $_POST["nombre"];

        if($nombre_formato != ""){
                
            $formato = new Formato();
            $resultado = $formato->agregarFormato($nombre_formato);
            if($resultado > 0){
            echo "se agregó el formato: ".$nombre_formato;
            }        

        }
                
    }

    //crear select con datos de almacen
    if($opcion === 'listar'){

        $formato = new Formato();
        $formatos = $formato->listarFormatos();
        echo'<select name="id_formato" id="id_formato" required>';
        echo '<option selected >-- seleccionar --</option>';

        if ($formatos->num_rows > 0) {
            // Recorrer formatos presentes
            while ($dato = $formatos->fetch_assoc()) {
                echo '<option value="' . $dato['id_formato'] . '">' . $dato['nombre_formato'] . '</option>';
            }
        } else {
            echo '<option value="0">NULL</option>';
        }

        echo'</select>';

    }

	if($opcion === "mostar")
    {
	    $formato = new Formato();
        $resultado = $formato->listarFormatos();
        while($consulta = mysqli_fetch_array($resultado))         
        {
            $id_formato = $consulta['id_formato'];
            $nombre_formato = $consulta['nombre_formato'];

            echo'
                <tr>
                    <td>'.$id_formato.'</td>
                    <td>
                        <span  id="nombre_formatoSpan'.$id_formato.'">'.$nombre_formato.'</span>                        
                        <input style="display:none" type="text" id="nombre_formatoTxt'.$id_formato.'" value="'.$nombre_formato.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon id="btnEditFotmato'.$id_formato.'" name="pencil-outline" class="icono-editar" onclick="editarFotmato('.$id_formato.')"></ion-icon>                        
                        <button style="display:none" id="guardarEditFotmato'.$id_formato.'" onclick="guardarFotmatoEdit('.$id_formato.')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarFormato('.$id_formato.')"></ion-icon></td> 
                </tr>
            ';
        }                            
    }	  

    //EDITAR FORMATO
    if($opcion === "editar")
    {
        $id_formato= $_POST["id"];
        $nombre_formato = $_POST["nombre"];

        if($id_formato != "" && $nombre_formato !=""){
                
            $formato = new Formato();
            $resultado = $formato->actualizarFormato($id_formato, $nombre_formato);
            if($resultado > 0){
            echo "se actualizó el fotmato: ".$nombre_formato;
            }        
        }                
    }

    //ELIMINAR FORMATO
    if($opcion === "eliminar")
    {
        $id_formato= $_POST["id"];

        if($id_formato != ""){

            try{

                $formato = new Formato();
                $formatot>= $formato->eliminarFormato($id_formato);
                if($resultado > 0){
                echo "se eliminó el formato: ".$id_formato;
                }

            }
            catch(Exception $e)
            {
                echo "<script>alert('No sepuede eliminar el formato: ".$id_formato."; Asegurese de que no esté asigando a un insumo.');</script>";
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
