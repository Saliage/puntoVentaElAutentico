<?php

require('conexion.php');

class Compra {

    // Agregar compra
    public function agregarCompra($fecha, $tipo_documento, $numero_documento, $total, $proveedor_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO compra (fecha_compra, tipo_documento, numero_documento, total, proveedor_id_proveedor)
                     VALUES ('$fecha', '$tipo_documento', '$numero_documento', '$total', '$proveedor_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las compras
    public function listarCompras() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM compra";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar compra por id
    public function buscarCompraId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM compra WHERE id_compra = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de compra
    public function actualizarCompra($id, $fecha, $tipo_documento, $numero_documento, $total, $proveedor_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE compra SET 
                    fecha_compra = '$fecha',
                    tipo_documento = '$tipo_documento',
                    numero_documento = '$numero_documento',
                    total = '$total',
                    proveedor_id_proveedor = '$proveedor_id'
                    WHERE id_compra = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar compra por id
    public function eliminarCompra($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM compra WHERE id_compra = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
