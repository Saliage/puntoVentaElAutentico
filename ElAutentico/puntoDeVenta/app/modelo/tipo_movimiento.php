<?php

require_once('conexion.php');

class TipoMovimiento {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar tipo de movimiento
    public function agregarTipoMovimiento($nombre) {
        $consulta = "INSERT INTO tipo_movimiento (nombre_tipo_mov) VALUES (?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("s", $nombre);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los tipos de movimiento
    public function listarTiposMovimiento() {
        $consulta = "SELECT * FROM tipo_movimiento";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar tipo de movimiento por id
    public function buscarTipoMovimientoId($id) {
        $consulta = "SELECT * FROM tipo_movimiento WHERE id_tipo_mov = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de tipo de movimiento
    public function actualizarTipoMovimiento($id, $nombre) {
        $consulta = "UPDATE tipo_movimiento SET nombre_tipo_mov = ? WHERE id_tipo_mov = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("si", $nombre, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar tipo de movimiento por id
    public function eliminarTipoMovimiento($id) {
        $consulta = "DELETE FROM tipo_movimiento WHERE id_tipo_mov = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}

?>
