<?php

require_once('conexion.php');

class TipoMovimiento {

    // Agregar tipo de movimiento
    public function agregarTipoMovimiento($nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO tipo_movimiento (nombre_tipo_movimiento)
                     VALUES ('$nombre')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los tipos de movimiento
    public function listarTiposMovimiento() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_movimiento";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar tipo de movimiento por id
    public function buscarTipoMovimientoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_movimiento WHERE id_tipo_movimiento = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    
    }

    // Actualizar datos de tipo de movimiento
    public function actualizarTipoMovimiento($id, $nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE tipo_movimiento SET
                    nombre_tipo_movimiento = '$nombre'
                    WHERE id_tipo_movimiento = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar tipo de movimiento por id
    public function eliminarTipoMovimiento($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM tipo_movimiento WHERE id_tipo_movimiento = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}

?>
