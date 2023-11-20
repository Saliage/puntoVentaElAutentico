<?php


require_once ("../modelo/cat.php");
// Validar que se ingresó de manera correcta, de lo contrario, devolver a pagina anterior.

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $opcion = $_POST['opcion']; //obtener valor de la opción para controlar eventos

    echo 
    '
        <table class="table table-hover">
        <tr>
        <th scope="col">#ID</th>
        <th scope="col">NOMBRE CATEGORIA</th>
        <th>EDITAR</th>
        <th>ELIMINAR</th> 
        </tr>
    ';

		if($opcion == 1)
        {
            $nombreCategorias = $_POST["nombre"];

            if($nombreCategorias != ""){
                
                $categorias = new Categorias();
                $resultado = $categorias->agregarCat($nombreCategorias);
                if($resultado > 0){
                echo "Se agregó la categoria: ".$nombreCategorias;
                }        

            }
                
        }

        if($opcion == "mostrar"){
            $categorias = new Categorias();
            $resultado = $categorias->listarCat();
            while($consulta = mysqli_fetch_array($resultado))         
            {
                $id_tipo = $consulta['id_tipo'];
                $nombre_tipo = $consulta['nombre_tipo'];
    
                echo'
                    <tr>
                        <td>'.$id_tipo.'</td>
                        <td>
                            <span  id="nombre_tipoSpan'.$id_tipo.'">'.$nombre_tipo.'</span>                        
                            <input style="display:none" type="text" id="nombre_tipoTxt'.$id_tipo.'" value="'.$nombre_tipo.'"> <!-- inicia oculto-->
                        </td>
                        <td>
                            <ion-icon id="btnEditCat'.$id_tipo.'" name="pencil-outline" class="icono-editar" onclick="editarCat('.$id_tipo.')"></ion-icon>                        
                            <button style="display:none" id="guardarEditCat'.$id_tipo.'" onclick="guardarCatEdit('.$id_tipo.')">OK</button> <!-- inicia oculto-->
                        </td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarCat('.$id_tipo.')"></ion-icon></td> 
                    </tr>
                ';
            }            
        }



        //editar

        if($opcion == "U")
        {
            $id_tipo = $_POST["id"];
            $nombreCategorias = $_POST["nombre"];

            if($id_tipo != ""){
                
                $categorias = new Categorias();
                $resultado = $categorias->actualizarCat($id_tipo, $nombreCategorias);
                if($resultado > 0){
                echo "Se actualizó la categoria: ".$nombreCategorias;
                }        

            }
                
        }

        
        

        // eliminar
        if($opcion == "D")
        {
            $id_tipo = $_POST["id"];

            if($id_tipo != ""){
                
                $categorias = new Categorias();
                try{

                    $resultado = $categorias->eliminarCat($id_tipo);
                    if($resultado > 0){
                    echo "Se eliminó la categoria: ".$id_tipo;
                    }

                }
                catch(Exception $e)
                {
                    echo "<script>alert('No se puede eliminar la categoria: ".$id_tipo."; Asegurese de que no esté asignada a un producto.');</script>";
                }        

            }
                
        }


	

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../carta-administrador.php"); 
    die();

}


?>
