<?php

require_once('conexion.php');

class Salida {

    // Agregar salida
    public function agregarSalida($fecha_salida, $trabajador_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO salida (fecha_salida, trabajador_id_trabajador)
                     VALUES ('$fecha_salida', '$trabajador_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las salidas
    public function listarSalidas() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM salida";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar salida por id
    public function buscarSalidaId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM salida WHERE id_salida = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de salida
    public function actualizarSalida($id, $fecha_salida, $trabajador_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE salida SET
                    fecha_salida = '$fecha_salida',
                    trabajador_id_trabajador = '$trabajador_id'
                    WHERE id_salida = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar salida por id
    public function eliminarSalida($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM salida WHERE id_salida = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
