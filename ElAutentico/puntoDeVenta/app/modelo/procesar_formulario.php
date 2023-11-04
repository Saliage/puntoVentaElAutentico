<?php
require 'conexion.php'; // Incluye el archivo de conexión a la base de datos

if (isset($_POST['agregar'])) {
    // Recopila datos del formulario
    $id_trabajador = $_POST['id_trabajador'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $rol = $_POST['rol'];

    $conexion = new Conexion();
    $conn = $conexion->abrirConexion();

    if (empty($id_trabajador)) {
        // Si el ID está vacío, inserta un nuevo usuario
        $query = "INSERT INTO trabajador (nombre, apellido, usuario, clave, rol_id_rol) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $nombre, $apellido, $usuario, $clave, $rol);
        $stmt->execute();
    } else {
        // Si el ID tiene un valor, actualiza el usuario existente
        $query = "UPDATE trabajador SET nombre = ?, apellido = ?, usuario = ?, clave = ?, rol_id_rol = ? WHERE id_trabajador = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssii", $nombre, $apellido, $usuario, $clave, $rol, $id_trabajador);
        $stmt->execute();
    }

    $conexion->cerrarConexion();

    // Redirige a la página principal después de la inserción o actualización
    header('Location: pagina_principal.php');
}
// Otras operaciones de edición y eliminación se pueden manejar de manera similar
?>

<?php
require 'conexion.php'; // Incluye el archivo de conexión a la base de datos

$conexion = new Conexion();
$conn = $conexion->abrirConexion();

$query = "SELECT id_trabajador, nombre, apellido, usuario, rol_id_rol FROM trabajador";
$result = $conn->query($query);

$conexion->cerrarConexion();
?>

<!-- Itera sobre los resultados de la consulta y muestra los usuarios en la tabla -->
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['nombre']}</td>";
            echo "<td>{$row['apellido']}</td>";
            echo "<td>{$row['usuario']}</td>";
            echo "<td>{$row['rol_id_rol']}</td>";
            echo "<td><a href='editar_usuario.php?id={$row['id_trabajador']}'>Editar</a></td>";
            echo "<td><a href='eliminar_usuario.php?id={$row['id_trabajador']}'>Eliminar</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
