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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("is", $compra_id, $fecha);

        $resultado = $sql->execute();

        $sql->close();
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

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de registro de entrada por compra
    public function actualizarRegEntradaCompra($id, $compra_id, $fecha) {
        $consulta = "UPDATE reg_entrada_compra SET compra_id_compra = ?, fecha = ? WHERE id_reg_entrada_compra = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("isi", $compra_id, $fecha, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar registro de entrada por compra por id
    public function eliminarRegEntradaCompra($id) {
        $consulta = "DELETE FROM reg_entrada_compra WHERE id_reg_entrada_compra = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}

?>
