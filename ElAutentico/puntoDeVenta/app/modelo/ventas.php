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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sdsiii", $fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id);

        $resultado = $sql->execute();

        $sql->close();
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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sdsiiii", $fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar venta por id
    public function eliminarVenta($id) {
        $consulta = "DELETE FROM ventas WHERE id_venta = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
