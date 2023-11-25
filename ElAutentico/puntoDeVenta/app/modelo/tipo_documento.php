<?php

require_once('conexion.php');

class TipoDocumento {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar tipo de documento
    public function agregarTipoDocumento($nombre) {
        $consulta = "INSERT INTO tipo_documento (nombre_tipo_documento) VALUES (?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("s", $nombre);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los tipos de documento
    public function listarTiposDocumento() {
        $consulta = "SELECT * FROM tipo_documento";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar tipo de documento por id
    public function buscarTipoDocumentoId($id) {
        $consulta = "SELECT * FROM tipo_documento WHERE id_tipo_documento = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de tipo de documento
    public function actualizarTipoDocumento($id, $nombre) {
        $consulta = "UPDATE tipo_documento SET nombre_tipo_documento = ? WHERE id_tipo_documento = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("si", $nombre, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar tipo de documento por id
    public function eliminarTipoDocumento($id) {
        $consulta = "DELETE FROM tipo_documento WHERE id_tipo_documento = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}

?>
