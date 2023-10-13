<?php

require('conexion.php');

class CategoriaInsumo {

    // Agregar categoría de insumo
    public function agregarCategoriaInsumo($nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "INSERT INTO categoria_insumo (nombre_categoria) VALUES ('$nombre')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las categorías de insumo
    public function listarCategoriasInsumo() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM categoria_insumo";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar categoría de insumo por id
    public function buscarCategoriaInsumoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM categoria_insumo WHERE id_categoria = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de categoría de insumo
    public function actualizarCategoriaInsumo($id, $nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "UPDATE categoria_insumo SET nombre_categoria = '$nombre' WHERE id_categoria = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar categoría de insumo por id
    public function eliminarCategoriaInsumo($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM categoria_insumo WHERE id_categoria = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
