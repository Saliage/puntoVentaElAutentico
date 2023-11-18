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

    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla con Despliegue</title>
    <style>
        /* Estilos para la tabla y el contenido adicional */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        #additionalInfo {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Tabla -->
    <table id="miTabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <tr data-info="Información adicional 1">
                <td>1</td>
                <td>Producto A</td>
                <td>Descripción del Producto A</td>
            </tr>
            <tr data-info="Información adicional 2">
                <td>2</td>
                <td>Producto B</td>
                <td>Descripción del Producto B</td>
            </tr>
            <!-- Agrega más filas según sea necesario -->
        </tbody>
    </table>

    <!-- Contenido adicional (inicialmente oculto) -->
    <div id="additionalInfo"></div>

    <script>
        // Agrega un evento clic a las filas de la tabla
        var filas = document.querySelectorAll('#miTabla tbody tr');

        filas.forEach(function(fila) {
            fila.addEventListener('click', function() {
                // Muestra la información adicional
                var infoAdicional = this.getAttribute('data-info');
                document.getElementById('additionalInfo').innerHTML = infoAdicional;
                document.getElementById('additionalInfo').style.display = 'block';
            });
        });
    </script>

</body>
</html>




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

