<?php

require_once('conexion.php');

class Promocion {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar promoción
    public function agregarPromocion($nombre, $precio, $fecha_inicio, $fecha_fin, $productos) {
        $consulta = "INSERT INTO promocion (nombre_promocion, precio, fecha_inicio, fecha_fin)
                     VALUES (?, ?, ?, ?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sdss", $nombre, $precio, $fecha_inicio, $fecha_fin);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las promociones
    public function listarPromociones() {
        $consulta = "SELECT * FROM promocion";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar promoción por id
    public function buscarPromocionId($id) {
        $consulta = "SELECT * FROM promocion WHERE id_promocion = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de promoción
    public function actualizarPromocion($id, $nombre, $precio, $fecha_inicio, $fecha_fin) {
        $consulta = "UPDATE promocion SET
                    nombre_promocion = ?,
                    precio = ?,
                    fecha_inicio = ?,
                    fecha_fin = ?
                    WHERE id_promocion = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sdssi", $nombre, $precio, $fecha_inicio, $fecha_fin, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar promoción por id
    public function eliminarPromocion($id) {
        $consulta = "DELETE FROM promocion WHERE id_promocion = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
