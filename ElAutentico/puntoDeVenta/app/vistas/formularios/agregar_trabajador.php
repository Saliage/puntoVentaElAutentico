<?php 
    include("../puntoVentaElAutentico/ElAutentico/puntoDeVenta/app/modelo/rol.php");
    $rol = new Rol();
    $roles = $rol->listarRoles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar trabajador</title>
</head>
<body>

        <!-- formulario simple agrega trabajador-->

        <form method="post" action="../gestion/gestion_trabajador.php">
            <label for="rut">RUT:</label>
            <input type="text" name="rut" id="rut" required><br>
    
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required><br>
    
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" required><br>
    
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" required><br>
    
            <label for="clave">Clave:</label>
            <input type="password" name="clave" id="clave" required><br>
    
            <label for="activo">Activo:</label>
            <select name="activo" id="activo">
                <option value=True selected>Sí</option>
                <option value=False >No</option>
            </select><br>
            
            <label for="rol_id">Rol ID:</label>
            <select name="rol_id" id="rol_id" required>
            <?php 
                if ($roles->num_rows > 0) {
                    // Recorrer roles presentes
                    while ($dato = $resultado->fetch_assoc()) {
                        echo '<option value="' . $dato['id_rol'] . '">' . $dato['nombre_rol'] . '</option>';
                    }
                } else {
                    echo '<option value="0">No Existen Datos</option>';
                }
                ?>
            </select>
    
            <input type="submit" value="Agregar Trabajador">
            
        </form>
    
</body>
</html>