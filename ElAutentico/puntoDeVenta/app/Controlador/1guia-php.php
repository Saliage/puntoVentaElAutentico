<?php 
//crear variable de ejemplo
$saludo = "Hola Mundo"

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tu pagina</title>
</head>
<body>
    aquí se agrega el contenido de la pagina en html con las etiquetas de siempre

    aqui puedo llamar una variable en php : <?php echo $saludo ?> 

</body>

<!-- crear cosigo js para ser llamado desde php -->
<script>
    function mostrarMensaje(){
        alert("hola mundo");
    }

</script>

</html>



<!-- ahora si necesitas mostrar codigo JS o html desde php se hace así:

<?php

//usar JS en PHP
echo '<script>mostrarMensaje();</script>'; //llama a ala función escrita más arriba

echo'
    <script>

    function mostrarNuevoMensaje(){

        // en esta zona puedo crear todo el codigo en js que necesite

        alert("Este es otro mensaje creado en PHP, con estructura de JS");
    }
    
    
    </script>
'; //  <--  recuerda siempre cerrar con el maldito ;

//usar HTML desde PHP
echo'

<h1>Este es un mensaje en H1 desde PHP</h1><br>

<!-- crear formulario HTML desde PHP -->

<form>
    <label for="name">Nombre:</label>
    <input type="text" name="nombre">
    <input type="submit" value="enviar>
</form>


'; // siempre cerrar esa cosa

?>

