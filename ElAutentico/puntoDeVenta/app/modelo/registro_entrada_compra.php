<?php

require_once('conexion.php');

class RegEntradaCompra {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar registro de entrada por compra
    public function agregarRegEntradaCompra($compra_id, $fecha) {
        $consulta = "INSERT INTO reg_entrada_compra (compra_id_compra, fecha) VALUES (?, ?)";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("is", $compra_id, $fecha);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los registros de entrada por compra
    public function listarRegEntradaCompra() {
        $consulta = "SELECT * FROM reg_entrada_compra";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar registro de entrada por compra por id
    public function buscarRegEntradaCompraId($id) {
        $consulta = "SELECT * FROM reg_entrada_compra WHERE id_reg_entrada_compra = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $stmt->close();

        return $resultado;
    }

    // Actualizar datos de registro de entrada por compra
    public function actualizarRegEntradaCompra($id, $compra_id, $fecha) {
        $consulta = "UPDATE reg_entrada_compra SET compra_id_compra = ?, fecha = ? WHERE id_reg_entrada_compra = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("isi", $compra_id, $fecha, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar registro de entrada por compra por id
    public function eliminarRegEntradaCompra($id) {
        $consulta = "DELETE FROM reg_entrada_compra WHERE id_reg_entrada_compra = ?";

        $stmt = $this->conn->prepare($consulta);
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $this->conn->close();

        return $resultado;
    }
}

?>
