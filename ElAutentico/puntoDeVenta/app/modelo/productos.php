<?php

require_once('conexion.php');

class Productos {

    // Agregar producto
    public function agregarProductos($nombre_producto, $codigo_producto, $imagen, $costo_unitario, $precio_venta, $descripcion,$disponible, $categorias_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO producto (nombre_producto, codigo_producto, imagen, costo_unitario, precio_venta, descripcion,disponible, tipo_producto_id_tipo)
                     VALUES ('$nombre_producto', '$codigo_producto', '$imagen', '$costo_unitario', '$precio_venta', '$descripcion','$disponible', '$categorias_id')";

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


    public function buscarProductos($busqueda) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        // preparamos cadena de busqueda para insertar en LIKE
        $nombre_prod = '%' . $busqueda . '%'; 

        $consulta = "SELECT * FROM producto WHERE nombre_producto LIKE ?";
        $sql = $conn->prepare($consulta);
        $sql->bind_param("s", $nombre_prod);
        $sql->execute();
        
        $resultado = $sql->get_result();

        $sql->close();
        $conectar->cerrarConexion();

        return $resultado;
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
    public function actualizarProductos($id, $nombre_producto, $codigo_producto, $imagen, $costo_unitario, $precio_venta, $descripcion, $disponible) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        if($codigo_producto == null){

            $consulta = "UPDATE producto SET
                    nombre_producto = '$nombre_producto',
                    imagen = '$imagen',
                    costo_unitario = '$costo_unitario',
                    precio_venta = '$precio_venta',
                    descripcion = '$descripcion',
                    disponible = '$disponible'
                    WHERE id_producto = '$id'";

            $resultado = $conn->query($consulta);

        }
        else
        {
            $consulta = "UPDATE producto SET
                    nombre_producto = '$nombre_producto',
                    codigo_producto = '$codigo_producto',
                    imagen = '$imagen',
                    costo_unitario = '$costo_unitario',
                    precio_venta = '$precio_venta',
                    descripcion = '$descripcion',
                    disponible = '$disponible'
                    WHERE id_producto = '$id'";

            $resultado = $conn->query($consulta);
        }

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
