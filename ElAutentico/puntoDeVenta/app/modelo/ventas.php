<?php

require_once('conexion.php');

class Ventas {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar venta
    public function agregarVenta($fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id) {
        $consulta = "INSERT INTO ventas (fecha_venta, monto, tipo_documento, numero_documento, trabajador_id_trabajador, forma_pago_id_forma_pago)
                     VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("sdsiii", $fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las ventas
    public function listarVentas() {
        $consulta = "SELECT * FROM ventas";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar venta por id
    public function buscarVentaId($id) {
        $consulta = "SELECT * FROM ventas WHERE id_venta = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de venta
    public function actualizarVenta($id, $fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id) {
        $consulta = "UPDATE ventas SET
                    fecha_venta = ?,
                    monto = ?,
                    tipo_documento = ?,
                    numero_documento = ?,
                    trabajador_id_trabajador = ?,
                    forma_pago_id_forma_pago = ?
                    WHERE id_venta = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("sdsiiii", $fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar venta por id
    public function eliminarVenta($id) {
        $consulta = "DELETE FROM ventas WHERE id_venta = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
