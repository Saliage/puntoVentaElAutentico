<?php

require_once('conexion.php');

class DetalleVenta {

    // Agregar detalle de venta
    public function agregarDetalleVenta($cantidad, $id_venta, $id_producto) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO detalle_venta (cantidad, ventas_id_venta, producto_id_product)
                     VALUES ('$cantidad','$id_venta', '$id_producto')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los detalles de venta
    public function listarDetallesVenta() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_venta";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar detalle de venta por id
    public function buscarDetalleVentaId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_venta WHERE id_detalle = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de detalle de venta
    public function actualizarDetalleVenta($id, $id_venta, $id_producto, $cantidad) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE detalle_venta SET
                    venta_id_venta = '$id_venta',
                    producto_id_producto = '$id_producto',
                    cantidad = '$cantidad'
                    WHERE id_detalle = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar detalle de venta por id
    public function eliminarDetalleVenta($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM detalle_venta WHERE id_detalle = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
