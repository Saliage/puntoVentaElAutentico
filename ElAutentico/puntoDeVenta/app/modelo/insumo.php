<?php

require_once('conexion.php');

class Insumo {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar insumo
    public function agregarInsumo($nombre_insumo, $perecible, $imagen, $categoria_id, $formato_id) {
        $consulta = "INSERT INTO insumos (nombre_insumo, perecible, imagen, categoria_insumo_id_categoria, formato_id_formato)
                     VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("sisii", $nombre_insumo, $perecible, $imagen, $categoria_id, $formato_id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los insumos
    public function listarInsumos() {
        $consulta = "SELECT * FROM insumos";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los insumos y su formato
    public function listarInsumoFormato() {
        $consulta = "SELECT i.id_insumo as id_insumo, CONCAT(i.nombre_insumo, ' ', f.nombre_formato) 
                    AS nombre_completo, i.perecible as perecible
                    FROM insumos i INNER JOIN formato f ON i.formato_id_formato = f.id_formato";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar insumo por id
    public function buscarInsumoId($id) {
        $consulta = "SELECT * FROM insumos WHERE id_insumo = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de insumo
    public function actualizarInsumo($id, $nombre_insumo, $perecible, $imagen, $categoria_id, $formato_id) {
        $nombre_insumo = mysqli_real_escape_string($this->conn, $nombre_insumo);

        $consulta = "UPDATE insumos SET
                    nombre_insumo = ?,
                    perecible = ?,
                    imagen = ?,
                    categoria_insumo_id_categoria = ?,
                    formato_id_formato = ?
                    WHERE id_insumo = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("sisiii", $nombre_insumo, $perecible, $imagen, $categoria_id, $formato_id, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar insumo por id
    public function eliminarInsumo($id) {
        $consulta = "DELETE FROM insumos WHERE id_insumo = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
