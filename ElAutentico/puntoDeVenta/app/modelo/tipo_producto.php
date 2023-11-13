<?php

require_once('conexion.php');

class TipoProducto {

    // Agregar tipo de producto
    public function agregarTipoProducto($nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO tipo_producto (nombre_tipo) VALUES ('$nombre')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los tipos de productos
    public function listarTiposProductos() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_producto";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar tipo de producto por id
    public function buscarTipoProductoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_producto WHERE id_tipo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de tipo de producto
    public function actualizarTipoProducto($id, $nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();
        $consulta = "UPDATE tipo_producto SET nombre_tipo = '$nombre' WHERE id_tipo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar tipo de producto por id
    public function eliminarTipoProducto($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM tipo_producto WHERE id_tipo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
