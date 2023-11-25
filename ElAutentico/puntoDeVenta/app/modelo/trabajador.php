<?php

require_once('conexion.php');

class Trabajador {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar trabajador
    public function agregarTrabajador($rut, $nombre, $apellido, $usuario, $clave, $activo, $rol_id) {
        $consulta = "INSERT INTO trabajador (rut, nombre, apellido, usuario, clave, activo, rol_id_rol)
                     VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("ssssssi", $rut, $nombre, $apellido, $usuario, $clave, $activo, $rol_id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los trabajadores
    public function listarTrabajadores() {
        $consulta = "SELECT * FROM trabajador";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar trabajador por id
    public function buscarTrabajadorId($id) {
        $consulta = "SELECT * FROM trabajador WHERE id_trabajador = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Verificar sesión
    public function verificarTrabajador($usuario, $clave) {
        $consulta = "SELECT * FROM trabajador WHERE usuario = ? AND clave = ? AND activo != 0";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("ss", $usuario, $clave);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de trabajador
    public function actualizarTrabajador($id, $rut, $nombre, $apellido, $usuario, $clave, $activo, $rol_id) {
        $consulta = "UPDATE trabajador SET
                    rut = ?,
                    nombre = ?,
                    apellido = ?,
                    usuario = ?,
                    clave = ?,
                    activo = ?,
                    rol_id_rol = ?
                    WHERE id_trabajador = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("ssssssii", $rut, $nombre, $apellido, $usuario, $clave, $activo, $rol_id, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar trabajador por id
    public function eliminarTrabajador($id) {
        $consulta = "DELETE FROM trabajador WHERE id_trabajador = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
