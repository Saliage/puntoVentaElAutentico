<?php

require_once('conexion.php');

class FormaPago {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar forma de pago
    public function agregarFormaPago($forma_pago) {
        $forma_pago = mysqli_real_escape_string($this->conn, $forma_pago);

        $consulta = "INSERT INTO forma_pago (forma_pago) VALUES (?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $forma_pago);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las formas de pago
    public function listarFormasPago() {
        $consulta = "SELECT * FROM forma_pago";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar forma de pago por id
    public function buscarFormaPagoId($id) {
        $consulta = "SELECT * FROM forma_pago WHERE id_forma_pago = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);
        
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de forma de pago
    public function actualizarFormaPago($id, $forma_pago) {
        $forma_pago = mysqli_real_escape_string($this->conn, $forma_pago);

        $consulta = "UPDATE forma_pago SET forma_pago = ? WHERE id_forma_pago = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("si", $forma_pago, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar forma de pago por id
    public function eliminarFormaPago($id) {
        $consulta = "DELETE FROM forma_pago WHERE id_forma_pago = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
