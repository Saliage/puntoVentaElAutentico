<?php

require_once('conexion.php');

class Promocion {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar promoción
    public function agregarPromocion($nombre, $precio, $fecha_inicio, $fecha_fin) {
        $consulta = "INSERT INTO promocion (nombre_promocion, precio, fecha_inicio, fecha_fin)
                     VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("sdss", $nombre, $precio, $fecha_inicio, $fecha_fin);

        $resultado = $stmt->execute();

        $stmt->close();
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

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

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

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("sdssi", $nombre, $precio, $fecha_inicio, $fecha_fin, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar promoción por id
    public function eliminarPromocion($id) {
        $consulta = "DELETE FROM promocion WHERE id_promocion = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
