<?php

require_once('conexion.php');

class Proveedor {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar proveedor
    public function agregarProveedor($nombre, $rut, $fono, $mail, $direccion) {
        $consulta = "INSERT INTO proveedor (nombre_proveedor, rut_proveedor, fono, mail, direccion)
                        VALUES (?, ?, ?, ?, ?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sssss", $nombre, $rut, $fono, $mail, $direccion);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los proveedores
    public function listarProveedores() {
        $consulta = "SELECT * FROM proveedor";
        
        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar proveedor por id
    public function buscarProveedorId($id) {
        $consulta = "SELECT * FROM proveedor WHERE id_proveedor = ?";
        
        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);
        
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de proveedor
    public function actualizarProveedor($id, $nombre, $rut, $fono, $mail, $direccion) {
        $consulta = "UPDATE proveedor SET
                    nombre_proveedor = ?,
                    rut_proveedor = ?,
                    fono = ?,
                    mail = ?,
                    direccion = ?
                    WHERE id_proveedor = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sssssi", $nombre, $rut, $fono, $mail, $direccion, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar proveedor por id
    public function eliminarProveedor($id) {
        $consulta = "DELETE FROM proveedor WHERE id_proveedor = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
