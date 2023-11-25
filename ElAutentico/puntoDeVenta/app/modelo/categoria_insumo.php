<?php

require_once('conexion.php');

class CategoriaInsumo {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar categoría de insumo
    public function agregarCategoriaInsumo($nombre) {
        $nombre = mysqli_real_escape_string($this->conn, $nombre);

        $consulta = "INSERT INTO categoria_insumo (nombre_categoria) VALUES (?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $nombre);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las categorías de insumo
    public function listarCategoriasInsumo() {
        $consulta = "SELECT * FROM categoria_insumo";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar categoría de insumo por id
    public function buscarCategoriaInsumoId($id) {
        $consulta = "SELECT * FROM categoria_insumo WHERE id_categoria = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);
        
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de categoría de insumo
    public function actualizarCategoriaInsumo($id, $nombre) {
        $nombre = mysqli_real_escape_string($this->conn, $nombre);

        $consulta = "UPDATE categoria_insumo SET nombre_categoria = ? WHERE id_categoria = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $nombre, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar categoría de insumo por id
    public function eliminarCategoriaInsumo($id) {
        $consulta = "DELETE FROM categoria_insumo WHERE id_categoria = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
