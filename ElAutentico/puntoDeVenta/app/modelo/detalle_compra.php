<?php

require_once('conexion.php');

class DetalleCompra {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar detalle de compra
    public function agregarDetalleCompra($nombre_articulo, $cantidad, $precio_unitario, $compra_id) {
        $nombre_articulo = mysqli_real_escape_string($this->conn, $nombre_articulo);

        $consulta = "INSERT INTO detalle_compra (nombre_articulo, cantidad, precio_unitario, compra_id_compra)
                     VALUES (?, ?, ?, ?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sidi", $nombre_articulo, $cantidad, $precio_unitario, $compra_id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los detalles de compra
    public function listarDetallesCompra() {
        $consulta = "SELECT * FROM detalle_compra";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar detalle de compra por id
    public function buscarDetalleCompraId($id) {
        $consulta = "SELECT * FROM detalle_compra WHERE id_detalle_compra = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);
        
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de detalle de compra
    public function actualizarDetalleCompra($id, $nombre_articulo, $cantidad, $precio_unitario, $compra_id) {
        $nombre_articulo = mysqli_real_escape_string($this->conn, $nombre_articulo);

        $consulta = "UPDATE detalle_compra SET
                    nombre_articulo = ?,
                    cantidad = ?,
                    precio_unitario = ?,
                    compra_id_compra = ?
                    WHERE id_detalle_compra = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sidii", $nombre_articulo, $cantidad, $precio_unitario, $compra_id, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar detalle de compra por id
    public function eliminarDetalleCompra($id) {
        $consulta = "DELETE FROM detalle_compra WHERE id_detalle_compra = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
