<?php

require_once('conexion.php');

class Productos {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar producto
    public function agregarProductos($nombre_producto, $codigo_producto, $imagen, $costo_unitario, $precio_venta, $descripcion, $disponible, $categorias_id) {
        $consulta = "INSERT INTO producto (nombre_producto, codigo_producto, imagen, costo_unitario, precio_venta, descripcion, disponible, tipo_producto_id_tipo)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sisddsii", $nombre_producto, $codigo_producto, $imagen, $costo_unitario, $precio_venta, $descripcion, $disponible, $categorias_id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Obtener todos los productos
    public function listarProductos() {
        $consulta = "SELECT * FROM producto";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    public function buscarProductos($busqueda) {
        //preparar cadena de busqueda con like
        $nombre_prod = '%' . $busqueda . '%';

        $consulta = "SELECT * FROM producto WHERE nombre_producto LIKE ?";
        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("s", $nombre_prod);
        $sql->execute();
        
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Obtener todos los productos disponibles
    public function listarProductosDisponibles() {
        $consulta = "SELECT * FROM producto WHERE disponible = 1";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    public function actualizarDisponibilidad($id, $disponible) {
          
        $consulta = "UPDATE producto SET disponible = ? WHERE id_producto = ?";
        
        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("ii", $disponible, $id);
    
        $resultado = $sql->execute();
    
        $sql->close();
    
        return $resultado;
    }
    

    // Buscar producto por id
    public function buscarProductosId($id) {
        $consulta = "SELECT * FROM producto WHERE id_producto = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de Producto
    public function actualizarProductos($id, $nombre_producto, $codigo_producto, $imagen, $costo_unitario, $precio_venta, $descripcion, $disponible) {
        if ($codigo_producto == null) {
            $consulta = "UPDATE producto SET
                        nombre_producto = ?,
                        imagen = ?,
                        costo_unitario = ?,
                        precio_venta = ?,
                        descripcion = ?,
                        disponible = ?
                        WHERE id_producto = ?";

            $sql = $this->conn->prepare($consulta);
            $sql->bind_param("ssddsii", $nombre_producto, $imagen, $costo_unitario, $precio_venta, $descripcion, $disponible, $id);
        } else {
            $consulta = "UPDATE producto SET
                        nombre_producto = ?,
                        codigo_producto = ?,
                        imagen = ?,
                        costo_unitario = ?,
                        precio_venta = ?,
                        descripcion = ?,
                        disponible = ?
                        WHERE id_producto = ?";

            $sql = $this->conn->prepare($consulta);
            $sql->bind_param("sisddsii", $nombre_producto, $codigo_producto, $imagen, $costo_unitario, $precio_venta, $descripcion, $disponible, $id);
        }

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar producto por id
    public function eliminarProductos($id) {
        $consulta = "DELETE FROM producto WHERE id_producto = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
