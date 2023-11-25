<?php

require_once('conexion.php');

class TipoProducto {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar tipo de producto
    public function agregarTipoProducto($nombre) {
        $consulta = "INSERT INTO tipo_producto (nombre_tipo) VALUES (?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("s", $nombre);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los tipos de productos
    public function listarTiposProductos() {
        $consulta = "SELECT * FROM tipo_producto";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar tipo de producto por id
    public function buscarTipoProductoId($id) {
        $consulta = "SELECT * FROM tipo_producto WHERE id_tipo = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de tipo de producto
    public function actualizarTipoProducto($id, $nombre) {
        $consulta = "UPDATE tipo_producto SET nombre_tipo = ? WHERE id_tipo = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("si", $nombre, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar tipo de producto por id
    public function eliminarTipoProducto($id) {
        $consulta = "DELETE FROM tipo_producto WHERE id_tipo = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
