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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("iii", $cantidad, $id_venta, $id_promocion);

        $resultado = $sql->execute();

        $sql->close();
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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de venta promoción
    public function actualizarVentaPromocion($id, $cantidad, $id_venta, $id_promocion) {
        $consulta = "UPDATE venta_promocion SET
                    cantidad = ?,
                    id_venta = ?,
                    id_promocion = ?
                    WHERE id_venta_promocion = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("iiii", $cantidad, $id_venta, $id_promocion, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar venta promoción por id
    public function eliminarVentaPromocion($id) {
        $consulta = "DELETE FROM venta_promocion WHERE id_venta_promocion = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
