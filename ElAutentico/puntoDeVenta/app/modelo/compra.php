<?php

require_once('conexion.php');

class Compra {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar compra
    public function agregarCompra($fecha, $tipo_documento, $numero_documento, $total, $proveedor_id) {
        $consulta = "INSERT INTO compra (fecha_compra, tipo_documento, numero_documento, total, proveedor_id_proveedor)
                     VALUES (?, ?, ?, ?, ?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("siidi", $fecha, $tipo_documento, $numero_documento, $total, $proveedor_id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las compras
    public function listarCompras() {
        $consulta = "SELECT * FROM compra";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar compra por id
    public function buscarCompraId($id) {
        $consulta = "SELECT * FROM compra WHERE id_compra = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);
        
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de compra
    public function actualizarCompra($id, $fecha, $tipo_documento, $numero_documento, $total, $proveedor_id) {
        $consulta = "UPDATE compra SET 
                    fecha_compra = ?,
                    tipo_documento = ?,
                    numero_documento = ?,
                    total = ?,
                    proveedor_id_proveedor = ?
                    WHERE id_compra = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("siidii", $fecha, $tipo_documento, $numero_documento, $total, $proveedor_id, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar compra por id
    public function eliminarCompra($id) {
        $consulta = "DELETE FROM compra WHERE id_compra = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
