<?php

require_once('conexion.php');

class ProductoPromocion {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar relación producto-promoción
    public function agregarProductoPromocion($producto_id, $promocion_id) {
        $consulta = "INSERT INTO producto_promocion (producto_id_producto, promocion_id_promocion)
                     VALUES (?, ?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("ii", $producto_id, $promocion_id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las relaciones producto-promoción
    public function listarProductoPromocion() {
        $consulta = "SELECT * FROM producto_promocion";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar relación producto-promoción por id
    public function buscarProductoPromocionId($id) {
        $consulta = "SELECT * FROM producto_promocion WHERE id_producto_promocion = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de relación producto-promoción
    public function actualizarProductoPromocion($id, $producto_id, $promocion_id) {
        $consulta = "UPDATE producto_promocion SET
                    producto_id_producto = ?,
                    promocion_id_promocion = ?
                    WHERE id_producto_promocion = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("iii", $producto_id, $promocion_id, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar relación producto-promoción por id
    public function eliminarProductoPromocion($id) {
        $consulta = "DELETE FROM producto_promocion WHERE id_producto_promocion = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
