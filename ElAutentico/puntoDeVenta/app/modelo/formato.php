<?php

require_once('conexion.php');

class Formato {

    // Agregar formato
    public function agregarFormato($nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "INSERT INTO formato (nombre_formato) VALUES ('$nombre')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los formatos
    public function listarFormatos() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM formato";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar formato por id
    public function buscarFormatoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM formato WHERE id_formato = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de formato
    public function actualizarFormato($id, $nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "UPDATE formato SET nombre_formato = '$nombre' WHERE id_formato = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar formato por id
    public function eliminarFormato($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM formato WHERE id_formato = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
