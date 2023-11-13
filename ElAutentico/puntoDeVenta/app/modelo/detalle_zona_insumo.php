<?php

require_once('conexion.php');

class DetalleZonaInsumo {

    // Agregar detalle de zona de insumo
    public function agregarDetalleZonaInsumo($cantidad, $insumos_id, $zona_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO detalle_zona_insumo (cantidad, insumos_id_insumo, zona_id_zona)
                     VALUES ('$cantidad', '$insumos_id', '$zona_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los detalles de zona de insumo
    public function listarDetallesZonaInsumo() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_zona_insumo";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar detalle de zona de insumo por id
    public function buscarDetalleZonaInsumoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_zona_insumo WHERE id_zona_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de detalle de zona de insumo
    public function actualizarDetalleZonaInsumo($id, $cantidad, $insumos_id, $zona_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE detalle_zona_insumo SET
                    cantidad = '$cantidad',
                    insumos_id_insumo = '$insumos_id',
                    zona_id_zona = '$zona_id'
                    WHERE id_zona_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar detalle de zona de insumo por id
    public function eliminarDetalleZonaInsumo($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM detalle_zona_insumo WHERE id_zona_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
