<?php

require_once('conexion.php');

class Almacen {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar almacen
    public function agregarAlmacen($nombre, $sala_venta) {
        $consulta = "INSERT INTO almacen (nombre, sala_venta) VALUES (?, ?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $nombre, $sala_venta);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los almacenes
    public function listarAlmacenes() {
        $consulta = "SELECT * FROM almacen";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar almacen por id
    public function buscarAlmacenId($id) {
        $consulta = "SELECT * FROM almacen WHERE id_almacen = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);
        
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Buscar almacenes por sala
    public function listarAlmacenesEnSala() {
        $consulta = "SELECT * FROM almacen WHERE sala_venta = 1";
        
        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de almacen
    public function actualizarAlmacen($id, $nombre, $sala_venta) {
        $nombre = mysqli_real_escape_string($this->conn, $nombre);

        $consulta = "UPDATE almacen SET nombre = ?, sala_venta = ? WHERE id_almacen = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sii", $nombre, $sala_venta, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar almacen por id
    public function eliminarAlmacen($id) {
        $consulta = "DELETE FROM almacen WHERE id_almacen = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>

