<?php 
    require("../../modelo/almacen.php");
    $almacen = new Almacen();
    $almacenes = $almacen->listarAlmacenes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar zona</title>
</head>
<body>
    <!-- formulario simple para agregar zona-->

    <form method="post" action="../gestion/gestion_zona.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="almacen_id">Almacen ID:</label>
        <select name="almacen_id" id="almacen_id" required>
        <?php 
            if ($almacenes->num_rows > 0) {
                // Recorrer almacenes presentes
                while ($dato = $almacenes->fetch_assoc()) {
                    echo '<option value="' . $dato['id_almacen'] . '">' . $dato['nombre'] . '</option>';
                }
            } else {
                echo '<option value="0">NULL</option>';
            }
        ?>
        </select>

        <input type="submit" value="Agregar Zona">
    </form>
</body>
</html>
