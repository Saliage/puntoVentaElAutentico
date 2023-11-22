<?php

require_once('conexion.php');

class Productos {

    // Agregar producto
    public function agregarProductos($nombre_producto, $codigo_producto, $imagen, $costo_unitario, $precio_venta, $descripcion, $categorias_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO producto (nombre_producto, codigo_producto, imagen, costo_unitario, precio_venta, descripcion, tipo_producto_id_tipo)
                     VALUES ('$nombre_producto', '$codigo_producto', '$imagen', '$costo_unitario', '$precio_venta', '$descripcion', '$categorias_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los productos
    public function listarProductos() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM producto";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

        // Obtener todos los productos
        public function listarProductosDisponibles() {
            $conectar = new Conexion();
            $conn = $conectar->abrirConexion();
    
            $consulta = "SELECT * FROM producto WHERE disponible = 1";
    
            $resultado = $conn->query($consulta);
    
            return $resultado;
            $conn->close();
        }

    // Buscar producto por id
    public function buscarProductosId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM producto WHERE id_producto = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    
    }

    // verificar sesion
    public function verificarTrabajador($usuario, $clave) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM trabajador WHERE usuario = '$usuario' and clave = '$clave' and activo != 0";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    
    }



    // Actualizar datos de Producto
    public function actualizarProductos($id, $nombre_producto, $codigo_producto, $imagen, $costo_unitario, $precio_venta, $descripcion, $categorias_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE producto SET
                    nombre_producto = '$nombre_producto',
                    codigo_producto = '$codigo_producto',
                    imagen = '$imagen',
                    costo_unitario = '$costo_unitario',
                    precio_venta = '$precio_venta',
                    descripcion = '$descripcion',
                    tipo_producto_id_tipo = '$categorias_id'
                    WHERE id_productor = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar producto por id
    public function eliminarProductos($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM producto WHERE id_producto = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
