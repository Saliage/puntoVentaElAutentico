<?php

require('conexion.php');

class DetalleEntradaInsumos {

    // Agregar detalle de entrada de insumos
    public function agregarDetalleEntradaInsumos($insumos_id, $entrada_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO detalle_entrada_insumos (insumos_id_insumo, entrada_id_entrada)
                     VALUES ('$insumos_id', '$entrada_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los detalles de entrada de insumos
    public function listarDetallesEntradaInsumos() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_entrada_insumos";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar detalle de entrada de insumos por id
    public function buscarDetalleEntradaInsumosId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM detalle_entrada_insumos WHERE id_detalle_entrada = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de detalle de entrada de insumos
    public function actualizarDetalleEntradaInsumos($id, $insumos_id, $entrada_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE detalle_entrada_insumos SET
                    insumos_id_insumo = '$insumos_id',
                    entrada_id_entrada = '$entrada_id'
                    WHERE id_detalle_entrada = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar detalle de entrada de insumos por id
    public function eliminarDetalleEntradaInsumos($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM detalle_entrada_insumos WHERE id_detalle_entrada = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
