<?php

require('conexion.php');

class FormaPago {

    // Agregar forma de pago
    public function agregarFormaPago($forma_pago) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $forma_pago = mysqli_real_escape_string($conn, $forma_pago);

        $consulta = "INSERT INTO forma_pago (forma_pago)
                     VALUES ('$forma_pago')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las formas de pago
    public function listarFormasPago() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM forma_pago";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar forma de pago por id
    public function buscarFormaPagoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM forma_pago WHERE id_forma_pago = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de forma de pago
    public function actualizarFormaPago($id, $forma_pago) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $forma_pago = mysqli_real_escape_string($conn, $forma_pago);

        $consulta = "UPDATE forma_pago SET
                    forma_pago = '$forma_pago'
                    WHERE id_forma_pago = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar forma de pago por id
    public function eliminarFormaPago($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM forma_pago WHERE id_forma_pago = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
