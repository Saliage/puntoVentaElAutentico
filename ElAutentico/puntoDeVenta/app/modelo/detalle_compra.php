<?php

require_once('conexion.php');

class DetalleCompra {

    // Agregar detalle de compra
    public function agregarDetalleCompra($nombre_articulo, $cantidad, $precio_unitario, $compra_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre_articulo = mysqli_real_escape_string($conn, $nombre_articulo);

        $consulta = "INSERT INTO detalle_compra (nombre_articulo, cantidad, precio_unitario, compra_id_compra)
                     VALUES ('$nombre_articulo', '$cantidad', '$precio_unitario', '$compra_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los detalles de compra
    public function listarDetallesCompra() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_compra";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar detalle de compra por id
    public function buscarDetalleCompraId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_compra WHERE id_detalle_compra = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de detalle de compra
    public function actualizarDetalleCompra($id, $nombre_articulo, $cantidad, $precio_unitario, $compra_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre_articulo = mysqli_real_escape_string($conn, $nombre_articulo);

        $consulta = "UPDATE detalle_compra SET
                    nombre_articulo = '$nombre_articulo',
                    cantidad = '$cantidad',
                    precio_unitario = '$precio_unitario',
                    compra_id_compra = '$compra_id'
                    WHERE id_detalle_compra = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar detalle de compra por id
    public function eliminarDetalleCompra($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM detalle_compra WHERE id_detalle_compra = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
