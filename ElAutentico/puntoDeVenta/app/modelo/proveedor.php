<?php

require_once('conexion.php');

class Proveedor {

    // Agregar proveedor
    public function agregarProveedor($nombre, $rut, $fono, $mail, $direccion) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO proveedor (nombre_proveedor, rut_proveedor, fono, mail, direccion)
                     VALUES ('$nombre', '$rut', '$fono', '$mail', '$direccion')";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Obtener todos los proveedores
    public function listarProveedores() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM proveedor";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar proveedor por id
    public function buscarProveedorId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM proveedor WHERE id_proveedor = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Actualizar datos de proveedor
    public function actualizarProveedor($id, $nombre, $rut, $fono, $mail, $direccion) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE proveedor SET
                    nombre_proveedor = '$nombre',
                    rut_proveedor = '$rut',
                    fono = '$fono',
                    mail = '$mail',
                    direccion = '$direccion'
                    WHERE id_proveedor = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Eliminar proveedor por id
    public function eliminarProveedor($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM proveedor WHERE id_proveedor = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();

    }
}
?>
