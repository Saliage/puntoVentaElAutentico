<?php

require_once('conexion.php');

class VentaPromocion {

    // Agregar venta promoción
    public function agregarVentaPromocion($id_venta, $id_promocion, $cantidad) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO venta_promocion (cantidad,id_venta, id_promocion)
                     VALUES ('$cantidad','$id_venta', '$id_promocion')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las ventas promoción
    public function listarVentasPromocion() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM venta_promocion";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar venta promoción por id
    public function buscarVentaPromocionId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM venta_promocion WHERE id_venta_promocion = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de venta promoción
    public function actualizarVentaPromocion($id, $cantidad, $id_venta, $id_promocion) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE venta_promocion SET
                    cantidad = '$cantidad',
                    id_venta = '$id_venta',
                    id_promocion = '$id_promocion'
                    WHERE id_venta_promocion = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar venta promoción por id
    public function eliminarVentaPromocion($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM venta_promocion WHERE id_venta_promocion = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
