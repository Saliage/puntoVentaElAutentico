<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Roles</title>
    <!-- Agrega enlaces a Bootstrap CSS y jQuery -->
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>CRUD de Roles</h2>

        <!-- Formulario para agregar un nuevo rol -->
        <form method="post" action="procesar.php">
            <div class="form-group">
                <label for="nombreRol">Nombre del Rol:</label>
                <input type="text" class="form-control" id="nombreRol" name="nombreRol" required>
            </div>
            <button type="submit" class="btn btn-primary" name="agregarRol">Agregar Rol</button>
        </form>

        <!-- Lista de Roles -->
        <h3>Lista de Roles</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('rol.php');
                $rol = new Rol();
                $result = $rol->listarRoles();
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id_rol'] . '</td>';
                    echo '<td>' . $row['nombre_rol'] . '</td>';
                    echo '<td>
                            <a href="editar.php?id=' . $row['id_rol'] . '">Editar</a>
                            <a href="eliminar.php?id=' . $row['id_rol'] . '">Eliminar</a>
                          </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
