<?php

require('conexion.php');

class Almacen {

    // Agregar almacen
    public function agregarAlmacen($nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "INSERT INTO almacen (nombre) VALUES ('$nombre')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los almacenes
    public function listarAlmacenes() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM almacen";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar almacen por id
    public function buscarAlmacenId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM almacen WHERE id_almacen = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de almacen
    public function actualizarAlmacen($id, $nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "UPDATE almacen SET nombre = '$nombre' WHERE id_almacen = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar almacen por id
    public function eliminarAlmacen($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM almacen WHERE id_almacen = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
