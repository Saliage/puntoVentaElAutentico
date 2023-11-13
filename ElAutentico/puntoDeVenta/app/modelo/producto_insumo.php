<?php

require_once('conexion.php');

class ProductoInsumo {

    // Agregar relación producto-insumo
    public function agregarProductoInsumo($cantidad, $producto_id, $insumo_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO producto_insumo (cantidad, producto_id_producto, insumos_id_insumo)
                     VALUES ('$cantidad', '$producto_id', '$insumo_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las relaciones producto-insumo
    public function listarProductoInsumo() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM producto_insumo";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar relación producto-insumo por id
    public function buscarProductoInsumoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM producto_insumo WHERE id_producto_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de relación producto-insumo
    public function actualizarProductoInsumo($id, $cantidad, $producto_id, $insumo_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE producto_insumo SET
                    cantidad = '$cantidad',
                    producto_id_producto = '$producto_id',
                    insumos_id_insumo = '$insumo_id'
                    WHERE id_producto_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar relación producto-insumo por id
    public function eliminarProductoInsumo($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM producto_insumo WHERE id_producto_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
