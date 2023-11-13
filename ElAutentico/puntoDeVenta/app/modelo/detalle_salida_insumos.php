<?php

require_once('conexion.php');

class DetalleSalidaInsumos {

    // Agregar detalle de salida de insumos
    public function agregarDetalleSalidaInsumos($salida_id, $insumos_id, $cantidad) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO detalle_salida_insumos (salida_id_salida, insumos_id_insumo, cantidad)
                     VALUES ('$salida_id', '$insumos_id', '$cantidad')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los detalles de salida de insumos
    public function listarDetallesSalidaInsumos() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_salida_insumos";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar detalle de salida de insumos por id
    public function buscarDetalleSalidaInsumosId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_salida_insumos WHERE id_detalle_salida = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de detalle de salida de insumos
    public function actualizarDetalleSalidaInsumos($id, $salida_id, $insumos_id,$cantidad) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE detalle_salida_insumos SET
                    salida_id_salida = '$salida_id',
                    insumos_id_insumo = '$insumos_id',
                    cantidad = '$cantidad'
                    WHERE id_detalle_salida = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar detalle de salida de insumos por id
    public function eliminarDetalleSalidaInsumos($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM detalle_salida_insumos WHERE id_detalle_salida = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
