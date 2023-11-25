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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $nombre);

        $resultado = $sql->execute();

        $sql->close();
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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de tipo de documento
    public function actualizarTipoDocumento($id, $nombre) {
        $consulta = "UPDATE tipo_documento SET nombre_tipo_documento = ? WHERE id_tipo_documento = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $nombre, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar tipo de documento por id
    public function eliminarTipoDocumento($id) {
        $consulta = "DELETE FROM tipo_documento WHERE id_tipo_documento = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}

?>
