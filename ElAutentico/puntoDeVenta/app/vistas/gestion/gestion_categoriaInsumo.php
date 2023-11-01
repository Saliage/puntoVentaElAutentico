<?php


require("../../modelo/categoria_insumo.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["categoria"])) {
        $nombrecategoria = $_POST["categoria"];

        $categoria = new CategoriaInsumo();
        $resultado = $categoria->agregarCategoriaInsumo($nombrecategoria);

        echo "se agregó la categoria: ".$resultado;
      
    } 

} 
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header("location: ../formularios/agregar_categoriainsumo.html"); 
    die();

}


?>
