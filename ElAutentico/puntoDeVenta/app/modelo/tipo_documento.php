<?php

require_once('conexion.php');

class TipoDocumento {

    // Agregar tipo de documento
    public function agregarTipoDocumento($nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO tipo_documento (nombre_tipo_documento)
                     VALUES ('$nombre')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los tipos de documento
    public function listarTiposDocumento() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_documento";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar tipo de documento por id
    public function buscarTipoDocumentoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_documento WHERE id_tipo_documento = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    
    }

    // Actualizar datos de tipo de documento
    public function actualizarTipoDocumento($id, $nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE tipo_documento SET
                    nombre_tipo_documento = '$nombre'
                    WHERE id_tipo_documento = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar tipo de documento por id
    public function eliminarTipoDocumento($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM tipo_documento WHERE id_tipo_documento = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}

?>
