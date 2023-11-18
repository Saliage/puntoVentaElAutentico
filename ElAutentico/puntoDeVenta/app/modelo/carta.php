<?php

require_once('conexion.php');

class Tipo_producto {

    // Agregar 
    public function agregarTipo_producto($nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "INSERT INTO tipo_producto (nombre_tipo) VALUES ('$nombre')";

        $resultado = $conn->query($consulta);

        
        return $resultado;
        $conn->close();
    }

    // Obtener todos los roles
    public function listarRoles() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_producto";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar categoria por id
    public function buscarTipo_productoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_producto WHERE id_tipo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar Categoria por parte del nombre
    public function buscarTipo_productoNombre($busqueda){
        
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM tipo_producto WHERE nombre_tipo LIKE '%$busqueda%' LIMIT 5";

        $resultado = $conn->query($consulta);
        return $resultado;
        $conn->close();
    }

    // Actualizar datos de rol
    public function actualizarTipo_producto($id, $nombre) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "UPDATE tipo_producto SET nombre_tipo = '$nombre' WHERE id_tipo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Eliminar rol por id
    public function eliminarTipo_producto($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM tipo_producto WHERE id_tipo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }
}
?>
