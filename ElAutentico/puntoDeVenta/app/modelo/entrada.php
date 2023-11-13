<?php

require_once('conexion.php');

class Entrada {

    // Agregar entrada
    public function agregarEntrada($fecha, $compra_id, $trabajador_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO entrada (fecha, compra_id_compra, trabajador_id_trabajador)
                     VALUES ('$fecha', '$compra_id', '$trabajador_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las entradas
    public function listarEntradas() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM entrada";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar entrada por id
    public function buscarEntradaId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM entrada WHERE id_entrada = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de entrada
    public function actualizarEntrada($id, $fecha, $compra_id, $trabajador_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE entrada SET
                    fecha = '$fecha',
                    compra_id_compra = '$compra_id',
                    trabajador_id_trabajador = '$trabajador_id'
                    WHERE id_entrada = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar entrada por id
    public function eliminarEntrada($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM entrada WHERE id_entrada = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
