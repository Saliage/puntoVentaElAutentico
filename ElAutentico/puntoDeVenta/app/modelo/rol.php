<?php

require_once('conexion.php');

class Rol {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar rol
    public function agregarRol($nombre) {
        $consulta = "INSERT INTO rol (nombre_rol) VALUES (?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("s", $nombre);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los roles
    public function listarRoles() {
        $consulta = "SELECT * FROM rol";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar rol por id
    public function buscarRolId($id) {
        $consulta = "SELECT * FROM rol WHERE id_rol = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Buscar rol por parte del nombre
    public function buscarRolNombre($busqueda) {
        $consulta = "SELECT * FROM rol WHERE nombre_rol LIKE ? LIMIT 5";
        $busqueda = "%$busqueda%";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("s", $busqueda);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de rol
    public function actualizarRol($id, $nombre) {
        $consulta = "UPDATE rol SET nombre_rol = ? WHERE id_rol = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("si", $nombre, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar rol por id
    public function eliminarRol($id) {
        $consulta = "DELETE FROM rol WHERE id_rol = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}

?>
