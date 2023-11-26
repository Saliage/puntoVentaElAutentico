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

    // Obtener todas las ventas
    public function listarVentasVendedor($id_vendedor) {
        $consulta = "SELECT v.id_venta as id, v.fecha_venta as fecha, v.monto as monto, f.forma_pago AS fPago
                    FROM ventas v INNER JOIN forma_pago f on f.id_forma_pago = v.forma_pago_id_forma_pago
                    WHERE v.trabajador_id_trabajador = ?";
    
        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id_vendedor);

        $sql->execute();
        $resultado = $sql->get_result();
    
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

}
?>
