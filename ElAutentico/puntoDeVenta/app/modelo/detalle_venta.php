<?php

require_once('conexion.php');

class DetalleVenta {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar detalle de venta
    public function agregarDetalleVenta($cantidad, $id_venta, $id_producto) {
        $consulta = "INSERT INTO detalle_venta (cantidad, ventas_id_venta, producto_id_product)
                     VALUES (?, ?, ?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("iii", $cantidad, $id_venta, $id_producto);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los detalles de venta
    public function listarDetallesVenta() {
        $consulta = "SELECT * FROM detalle_venta";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar detalle de venta por id
    public function buscarDetalleVentaId($id) {
        $consulta = "SELECT * FROM detalle_venta WHERE id_detalle = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);
        
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de detalle de venta
    public function actualizarDetalleVenta($id, $id_venta, $id_producto, $cantidad) {
        $consulta = "UPDATE detalle_venta SET
                    ventas_id_venta = ?,
                    producto_id_product = ?,
                    cantidad = ?
                    WHERE id_detalle = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("iiii", $id_venta, $id_producto, $cantidad, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar detalle de venta por id
    public function eliminarDetalleVenta($id) {
        $consulta = "DELETE FROM detalle_venta WHERE id_detalle = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
