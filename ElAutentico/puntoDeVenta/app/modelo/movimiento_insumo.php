<?php

require_once('conexion.php');

class MovimientoInsumo {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar movimiento de insumo
    public function agregarMovimientoInsumo($insumo_id, $tipo_movimiento_id, $cantidad, $fecha) {
        $consulta = "INSERT INTO movimiento_insumo (insumo_id_insumo, tipo_movimiento_id, cantidad, fecha)
                     VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("iids", $insumo_id, $tipo_movimiento_id, $cantidad, $fecha);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los movimientos de insumo
    public function listarMovimientosInsumo() {
        $consulta = "SELECT * FROM movimiento_insumo";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar movimiento de insumo por id
    public function buscarMovimientoInsumoId($id) {
        $consulta = "SELECT * FROM movimiento_insumo WHERE id_movimiento_insumo = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de movimiento de insumo
    public function actualizarMovimientoInsumo($id, $insumo_id, $tipo_movimiento_id, $cantidad, $fecha) {
        $consulta = "UPDATE movimiento_insumo SET
                    insumo_id_insumo = ?,
                    tipo_movimiento_id = ?,
                    cantidad = ?,
                    fecha = ?
                    WHERE id_movimiento_insumo = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("iidsi", $insumo_id, $tipo_movimiento_id, $cantidad, $fecha, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar movimiento de insumo por id
    public function eliminarMovimientoInsumo($id) {
        $consulta = "DELETE FROM movimiento_insumo WHERE id_movimiento_insumo = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}

?>
