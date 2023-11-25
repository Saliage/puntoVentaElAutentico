<?php

require_once('conexion.php');

class VentaPromocion {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar venta promoción
    public function agregarVentaPromocion($id_venta, $id_promocion, $cantidad) {
        $consulta = "INSERT INTO venta_promocion (cantidad, id_venta, id_promocion)
                     VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("iii", $cantidad, $id_venta, $id_promocion);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las ventas promoción
    public function listarVentasPromocion() {
        $consulta = "SELECT * FROM venta_promocion";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar venta promoción por id
    public function buscarVentaPromocionId($id) {
        $consulta = "SELECT * FROM venta_promocion WHERE id_venta_promocion = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de venta promoción
    public function actualizarVentaPromocion($id, $cantidad, $id_venta, $id_promocion) {
        $consulta = "UPDATE venta_promocion SET
                    cantidad = ?,
                    id_venta = ?,
                    id_promocion = ?
                    WHERE id_venta_promocion = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("iiii", $cantidad, $id_venta, $id_promocion, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar venta promoción por id
    public function eliminarVentaPromocion($id) {
        $consulta = "DELETE FROM venta_promocion WHERE id_venta_promocion = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
