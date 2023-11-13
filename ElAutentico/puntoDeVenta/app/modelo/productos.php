<?php

require_once('conexion.php');

class Producto{

    // agregar producto
    public function agregarProducto($cod_prod,$nom_prod,$costo_u,$precio_v,$descripcion,$id_tipo){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO producto (codigo_producto,nombre_producto,costo_unitario,precio_venta,descripcion,tipo_producto_id_tipo)
         VALUES ('$cod_prod','$nom_prod','$costo_u','$precio_v','$descripcion','$id_tipo')";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

    // Obtener todos los productos
    public function listarProductos(){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "select * from producto";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

    //Buscar producto por id
    public function buscarProductoId(int $id){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "select * from producto where id_producto = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

    //buscar producto por codigo de barra
    public function buscarProductoCodigo(int $codigo){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "select * from producto where codigo_producto = '$codigo'";

        $resultado = $conn->query($consulta);

        return $resultado;

    }


    //actualizar datos de producto
    public function actualizarProducto($id,$cod_prod,$nom_prod,$costo_u,$precio_v,$descripcion,$id_tipo){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE producto SET 
                    codigo_producto = '$cod_prod',
                    nombre_producto = '$nom_prod',
                    costo_unitario = '$costo_u',
                    precio_venta = '$precio_v',
                    descripcion = '$descripcion',
                    tipo_producto_id_tipo = '$id_tipo'                    
                    where id_producto = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

        //eliminar producto por id
        public function eliminarProducto($id){

            $conectar = new Conexion();
            $conn = $conectar->abrirConexion();
    
            $consulta = "DELETE from producto where id_producto = '$id'";
    
            $resultado = $conn->query($consulta);
    
            return $resultado;
    
        }


} 

?>