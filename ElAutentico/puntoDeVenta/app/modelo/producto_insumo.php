<?php

require_once('conexion.php');

class ProductoInsumo {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar relación producto-insumo
    public function agregarProductoInsumo($cantidad, $producto_id, $insumo_id) {
        $consulta = "INSERT INTO producto_insumo (cantidad, producto_id_producto, insumos_id_insumo)
                     VALUES (?, ?, ?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("dii", $cantidad, $producto_id, $insumo_id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las relaciones producto-insumo
    public function listarProductoInsumo() {
        $consulta = "SELECT * FROM producto_insumo";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar relación producto-insumo por id
    public function buscarProductoInsumoId($id) {
        $consulta = "SELECT * FROM producto_insumo WHERE id_producto_insumo = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de relación producto-insumo
    public function actualizarProductoInsumo($id, $cantidad, $producto_id, $insumo_id) {
        $consulta = "UPDATE producto_insumo SET
                    cantidad = ?,
                    producto_id_producto = ?,
                    insumos_id_insumo = ?
                    WHERE id_producto_insumo = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("diii", $cantidad, $producto_id, $insumo_id, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar relación producto-insumo por id
    public function eliminarProductoInsumo($id) {
        $consulta = "DELETE FROM producto_insumo WHERE id_producto_insumo = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
