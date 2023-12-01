<?php
require_once("../modelo/categoria_insumo.php");

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
                    <th>Categoría</th>
                    <th>Editar</th>
                    <th>Eliminar</th> 
                </tr>
                    
            </thead>
        ';
    }

	if($opcion === "guardar")
    {
        $nombreCategoria = $_POST["nombre"];

        if($nombreCategoria != ""){
                
            $categoria = new CategoriaInsumo();
            $resultado = $categoria->agregarCategoriaInsumo($nombreCategoria);
            if($resultado > 0){
            echo "se agregó la categoria: ".$nombreCategoria;
            }        

        }
                
    }

     //crear select con datos de Categoría
     if($opcion === 'listar'){

        $categoria = new CategoriaInsumo();
        $categorias = $categoria->listarCategoriasInsumo();
        echo'<select name="id_categoria" id="id_categoria" required>';
        echo '<option selected >-- seleccionar --</option>';

        if ($categorias->num_rows > 0) {
            // Recorrer formatos presentes
            while ($dato = $categorias->fetch_assoc()) {
                echo '<option value="' . $dato['id_categoria'] . '">' . $dato['nombre_categoria'] . '</option>';
            }
        } else {
            echo '<option value="0">NULL</option>';
        }

        echo'</select>';

    }

	if($opcion === "mostar")
    {
	    $categoria = new CategoriaInsumo();
        $resultado = $categoria->listarCategoriasInsumo();

        while($consulta = mysqli_fetch_array($resultado)) 
        {
            $id_categoria = $consulta['id_categoria'];
            $nombreCategoria = $consulta['nombre_categoria'];

            echo'
                <tr>
                    <td>'.$id_categoria.'</td>
                    <td>
                        <span  id="nombre_CategoriaSpan'.$id_categoria.'">'.$nombreCategoria.'</span>                        
                        <input style="display:none" type="text" id="nombre_CategoriaTxt'.$id_categoria.'" value="'.$nombreCategoria.'"> <!-- inicia oculto-->
                    </td>
                    <td>
                        <ion-icon id="btnEditCategoria'.$id_categoria.'" name="pencil-outline" class="icono-editar" onclick="editarCategoria('.$id_categoria.')"></ion-icon>                        
                        <button style="display:none" id="guardarEditCategoria'.$id_categoria.'" onclick="guardarCategoriaEdit('.$id_categoria.')">OK</button> <!-- inicia oculto-->
                    </td>
                    <td><ion-icon name="trash-outline" class="icono-eliminar" onclick="eliminarCategoria('.$id_categoria.')"></ion-icon></td> 
                </tr>
            ';
        }                            
    }	  

    //EDITAR Categoria
    if($opcion === "editar")
    {
        $id_categoria= $_POST["id"];
        $nombreCategoria = $_POST["nombre"];

        if($id_categoria != "" && $nombreCategoria !=""){
                
            $categoria = new CategoriaInsumo();
            $resultado = $categoria->actualizarCategoriaInsumo($id_categoria,$nombreCategoria);
            if($resultado > 0){
            echo "se actualizó la categoria: ".$nombreCategoria;
            }        
        }                
    }

    //ELIMINAR Categoria
    if($opcion === "eliminar")
    {
        $id_categoria= $_POST["id"];

        if($id_categoria != ""){
            
            $categoria = new CategoriaInsumo();
            try{

                $resultado = $categoria->eliminarCategoriaInsumo($id_categoria);
                if($resultado > 0){
                echo "se eliminó la categoria: ".$id_categoria;
                }

            }
            catch(Exception $e)
            {
                echo "<script>alert('No sepuede eliminar la categoria: ".$id_categoria."; Asegurese de que no esté asigando a un insumo.');</script>";
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
