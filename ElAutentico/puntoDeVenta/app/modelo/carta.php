<?php

require_once('conexion.php');

class Tipo_producto {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar Productos
    public function agregarProductos($nombre) {
        $nombre = mysqli_real_escape_string($this->conn, $nombre);

        $consulta = "INSERT INTO tipo_producto (nombre_tipo) VALUES (?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $nombre);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los roles
    public function listarCat() {
        $consulta = "SELECT * FROM tipo_producto";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar categoria por id
    public function buscarProductosId($id) {
        $consulta = "SELECT * FROM tipo_producto WHERE id_tipo = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);
        
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Buscar Categoria por parte del nombre
    public function buscarProductosNombre($busqueda){
        $consulta = "SELECT * FROM tipo_producto WHERE nombre_tipo LIKE ? LIMIT 5";

        $busqueda = "%$busqueda%";
        
        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $busqueda);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de productos
    public function actualizarProductos($id, $nombre) {
        $nombre = mysqli_real_escape_string($this->conn, $nombre);

        $consulta = "UPDATE tipo_producto SET nombre_tipo = ? WHERE id_tipo = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $nombre, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar rol por id
    public function eliminarProductos($id) {
        $consulta = "DELETE FROM tipo_producto WHERE id_tipo = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
