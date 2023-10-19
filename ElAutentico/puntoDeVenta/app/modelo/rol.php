<?php

require('conexion.php');

class Rol {

    // Agregar rol
    public function agregarRol($nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "INSERT INTO rol (nombre_rol) VALUES ('$nombre')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los roles
    public function listarRoles() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM rol";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar rol por id
    public function buscarRolId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM rol WHERE id_rol = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de rol
    public function actualizarRol($id, $nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "UPDATE rol SET nombre_rol = '$nombre' WHERE id_rol = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar rol por id
    public function eliminarRol($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM rol WHERE id_rol = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
