<?php

require_once('conexion.php');

class ProductoPromocion {

    // Agregar relación producto-promoción
    public function agregarProductoPromocion($producto_id, $promocion_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO producto_promocion (producto_id_producto, promocion_id_promocion)
                     VALUES ('$producto_id', '$promocion_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las relaciones producto-promoción
    public function listarProductoPromocion() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM producto_promocion";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar relación producto-promoción por id
    public function buscarProductoPromocionId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM producto_promocion WHERE id_producto_promocion = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de relación producto-promoción
    public function actualizarProductoPromocion($id, $producto_id, $promocion_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE producto_promocion SET
                    producto_id_producto = '$producto_id',
                    promocion_id_promocion = '$promocion_id'
                    WHERE id_producto_promocion = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar relación producto-promoción por id
    public function eliminarProductoPromocion($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM producto_promocion WHERE id_producto_promocion = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
