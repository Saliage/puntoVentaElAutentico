<?php

require_once('conexion.php');

class Ventas {

    // Agregar venta
    public function agregarVenta($fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $fecha_venta = mysqli_real_escape_string($conn, $fecha_venta);
        $tipo_documento = mysqli_real_escape_string($conn, $tipo_documento);

        $consulta = "INSERT INTO ventas (fecha_venta, monto, tipo_documento, numero_documento, trabajador_id_trabajador, forma_pago_id_forma_pago)
                     VALUES ('$fecha_venta', '$monto', '$tipo_documento', '$numero_documento', '$trabajador_id', '$forma_pago_id')";

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
    public function actualizarVenta($id, $fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $fecha_venta = mysqli_real_escape_string($conn, $fecha_venta);
        $tipo_documento = mysqli_real_escape_string($conn, $tipo_documento);

        $consulta = "UPDATE ventas SET
                    fecha_venta = '$fecha_venta',
                    monto = '$monto',
                    tipo_documento = '$tipo_documento',
                    numero_documento = '$numero_documento',
                    trabajador_id_trabajador = '$trabajador_id',
                    forma_pago_id_forma_pago = '$forma_pago_id'
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
