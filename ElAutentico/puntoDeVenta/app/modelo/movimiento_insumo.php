<?php

require_once('conexion.php');

class MovimientoInsumo {

    // Agregar movimiento de insumo
    public function agregarMovimientoInsumo($insumo_id, $tipo_movimiento_id, $cantidad, $fecha) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO movimiento_insumo (insumo_id_insumo, tipo_movimiento_id, cantidad, fecha)
                     VALUES ('$insumo_id', '$tipo_movimiento_id', '$cantidad', '$fecha')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los movimientos de insumo
    public function listarMovimientosInsumo() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM movimiento_insumo";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar movimiento de insumo por id
    public function buscarMovimientoInsumoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM movimiento_insumo WHERE id_movimiento_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    
    }

    // Actualizar datos de movimiento de insumo
    public function actualizarMovimientoInsumo($id, $insumo_id, $tipo_movimiento_id, $cantidad, $fecha) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE movimiento_insumo SET
                    insumo_id_insumo = '$insumo_id',
                    tipo_movimiento_id = '$tipo_movimiento_id',
                    cantidad = '$cantidad',
                    fecha = '$fecha'
                    WHERE id_movimiento_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar movimiento de insumo por id
    public function eliminarMovimientoInsumo($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM movimiento_insumo WHERE id_movimiento_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}

?>
