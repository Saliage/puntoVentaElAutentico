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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $nombre);

        $resultado = $sql->execute();

        $sql->close();
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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Buscar rol por parte del nombre
    public function buscarRolNombre($busqueda) {
        $consulta = "SELECT * FROM rol WHERE nombre_rol LIKE ? LIMIT 5";
        $busqueda = "%$busqueda%";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $busqueda);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de rol
    public function actualizarRol($id, $nombre) {
        $consulta = "UPDATE rol SET nombre_rol = ? WHERE id_rol = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $nombre, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar rol por id
    public function eliminarRol($id) {
        $consulta = "DELETE FROM rol WHERE id_rol = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}

?>
