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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $nombre);

        $resultado = $sql->execute();

        $sql->close();
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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de tipo de movimiento
    public function actualizarTipoMovimiento($id, $nombre) {
        $consulta = "UPDATE tipo_movimiento SET nombre_tipo_mov = ? WHERE id_tipo_mov = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $nombre, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar tipo de movimiento por id
    public function eliminarTipoMovimiento($id) {
        $consulta = "DELETE FROM tipo_movimiento WHERE id_tipo_mov = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}

?>
