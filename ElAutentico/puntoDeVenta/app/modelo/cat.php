<?php

require_once('conexion.php');

class Categorias {

    // Agregar categoria
    public function agregarCat($nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "INSERT INTO tipo_producto (nombre_tipo) VALUES ('$nombre')";

        $resultado = $conn->query($consulta);

        
        return $resultado;
        $conn->close();
    }

    // Obtener todos las categorias
    public function listarCat() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_producto";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar cataegoria por id
    public function buscarCatId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_producto WHERE id_tipo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar categoria por parte del nombre
    public function buscarCatNombre($busqueda){
        
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_producto WHERE nombre_tipo LIKE '%$busqueda%' LIMIT 5";

        $resultado = $conn->query($consulta);
        return $resultado;
        $conn->close();
    }

    // Actualizar datos de categoria
    public function actualizarCat($id, $nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "UPDATE tipo_producto SET nombre_tipo = '$nombre' WHERE id_tipo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Eliminar categoria por id
    public function eliminarCat($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM tipo_producto WHERE id_tipo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }
}
?>
