<?php

require_once('conexion.php');

class Ventas {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar venta
    public function agregarVenta($monto, $trabajador_id, $forma_pago_id, $carrito) {
        $consulta = "INSERT INTO ventas (fecha_venta, monto, trabajador_id_trabajador, forma_pago_id_forma_pago)
                     VALUES (NOW(), ?, ?, ?)";
    
        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("dii", $monto, $trabajador_id, $forma_pago_id);
    
        $resultado = $sql->execute();
    
        // Rescatar id autoincremental para poder guardar detalles de venta
        $id_venta = $this->conn->insert_id;
    
        // Por cada producto en el carrito, insertar un registro
        foreach ($carrito as $producto) {
            $cantidad = $producto['cantidad'];
            $producto_id = $producto['id'];
    
            $consulta = "INSERT INTO detalle_venta (cantidad, producto_id_producto, ventas_id_venta)
                        VALUES (?, ?, ?)";
            $sql = $this->conn->prepare($consulta);
            $sql->bind_param("iii", $cantidad, $producto_id, $id_venta);
            $sql->execute();
        }
    
        $sql->close();
        $this->conn->close();
    
        return $resultado;
    }
    

    // Obtener todas las ventas
    public function listarVentas() {
        $consulta = "SELECT * FROM ventas";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar venta por id
    public function buscarVentaId($id) {
        $consulta = "SELECT * FROM ventas WHERE id_venta = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de venta
    public function actualizarVenta($id, $fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id) {
        $consulta = "UPDATE ventas SET
                    fecha_venta = ?,
                    monto = ?,
                    tipo_documento = ?,
                    numero_documento = ?,
                    trabajador_id_trabajador = ?,
                    forma_pago_id_forma_pago = ?
                    WHERE id_venta = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sdsiiii", $fecha_venta, $monto, $tipo_documento, $numero_documento, $trabajador_id, $forma_pago_id, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar venta por id
    public function eliminarVenta($id) {
        $consulta = "DELETE FROM ventas WHERE id_venta = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
