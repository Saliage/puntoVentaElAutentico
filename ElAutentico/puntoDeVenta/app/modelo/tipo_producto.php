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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $nombre);

        $resultado = $sql->execute();

        $sql->close();
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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de tipo de producto
    public function actualizarTipoProducto($id, $nombre) {
        $consulta = "UPDATE tipo_producto SET nombre_tipo = ? WHERE id_tipo = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $nombre, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar tipo de producto por id
    public function eliminarTipoProducto($id) {
        $consulta = "DELETE FROM tipo_producto WHERE id_tipo = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
