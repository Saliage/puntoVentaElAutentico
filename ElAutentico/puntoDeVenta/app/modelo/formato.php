<?php

require_once('conexion.php');

class Formato {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar formato
    public function agregarFormato($nombre) {
        $consulta = "INSERT INTO formato (nombre_formato) VALUES (?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $nombre);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los formatos
    public function listarFormatos() {
        $consulta = "SELECT * FROM formato";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar formato por id
    public function buscarFormatoId($id) {
        $consulta = "SELECT * FROM formato WHERE id_formato = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);
        
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de formato
    public function actualizarFormato($id, $nombre) {
        $consulta = "UPDATE formato SET nombre_formato = ? WHERE id_formato = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $nombre, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar formato por id
    public function eliminarFormato($id) {
        $consulta = "DELETE FROM formato WHERE id_formato = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
