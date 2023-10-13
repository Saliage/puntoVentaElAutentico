<?php

require('conexion.php');

class Ventas {

    // Agregar venta
    public function agregarVenta($fecha_venta, $monto, $fpago, $tipo_documento, $numero_documento, $trabajador_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO ventas (fecha_venta, monto, fpago, tipo_documento, numero_documento, trabajador_id_trabajador)
                     VALUES ('$fecha_venta', '$monto', '$fpago', '$tipo_documento', '$numero_documento', '$trabajador_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las ventas
    public function listarVentas() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM ventas";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar venta por id
    public function buscarVentaId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM ventas WHERE id_venta = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de venta
    public function actualizarVenta($id, $fecha_venta, $monto, $fpago, $tipo_documento, $numero_documento, $trabajador_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE ventas SET
                    fecha_venta = '$fecha_venta',
                    monto = '$monto',
                    fpago = '$fpago',
                    tipo_documento = '$tipo_documento',
                    numero_documento = '$numero_documento',
                    trabajador_id_trabajador = '$trabajador_id'
                    WHERE id_venta = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar venta por id
    public function eliminarVenta($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM ventas WHERE id_venta = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
