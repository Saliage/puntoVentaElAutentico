<?php

require_once('conexion.php');

class Zona {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar zona
    public function agregarZona($nombre, $almacen_id) {
        $consulta = "INSERT INTO zona (nombre_zona, almacen_id_almacen) VALUES (?, ?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $nombre, $almacen_id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las zonas
    public function listarZonas() {
        $consulta = "SELECT * FROM zona";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar zona por id
    public function buscarZonaId($id) {
        $consulta = "SELECT * FROM zona WHERE id_zona = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Listar zonas según almacen
    public function buscarZonaPorAlmacen($id_almacen){
        $consulta = "SELECT * FROM zona WHERE almacen_id_almacen = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id_almacen);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de zona
    public function actualizarZona($id, $nombre, $almacen_id) {
        $consulta = "UPDATE zona SET nombre_zona = ?, almacen_id_almacen = ? WHERE id_zona = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sii", $nombre, $almacen_id, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar zona por id
    public function eliminarZona($id) {
        $consulta = "DELETE FROM zona WHERE id_zona = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
