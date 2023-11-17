<?php

require_once('conexion.php');

class Inventario{

    // agregar registro de inventario
    public function agregarRegistro($id_insumo, $id_movimiento, $cantidad, $costo_unitario, $fecha_vencimiento, $id_zona){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO inventario (id_insumo, id_movimiento, cantidad, costo_unitario, fecha_vencimiento, id_zona)
         VALUES ('$id_insumo', '$id_movimiento', '$cantidad', '$costo_unitario', '$fecha_vencimiento', '$id_zona')";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

    // Obtener todos los registros de inventario
    public function listarRegistros(){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM inventario";

        $resultado = $conn->query($consulta);

        return $resultado;

    }


    // Actualizar datos de registro de inventario
    public function actualizarRegistro($numero_registro, $id_insumo, $id_movimiento, $cantidad, $costo_unitario, $fecha_vencimiento, $id_zona){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE inventario SET 
                    id_insumo = '$id_insumo',
                    id_movimiento = '$id_movimiento',
                    cantidad = '$cantidad',
                    costo_unitario = '$costo_unitario',
                    fecha_vencimiento = '$fecha_vencimiento',
                    id_zona = '$id_zona'
                    WHERE numero_registro = '$numero_registro'";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

    // Obtener los datos de insumos disponibles, ordenados por fecha de vencimiento según el insumo especifico
    public function obtenerInsumosPorFecha($id_insumo){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT id_insumo, cantidad, costo_unitario, fecha_vencimiento 
                     FROM inventario 
                     WHERE cantidad > 0 AND id_insumo = '$id_insumo'
                     ORDER BY fecha_vencimiento ASC";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

    // Obtener la cantidad de insumos disponibles por cada insumo
    public function obtenerCantidadTotalPorInsumo(){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT id_insumo, SUM(cantidad) AS total_insumos 
                    FROM inventario 
                    WHERE cantidad > 0 
                    GROUP BY id_insumo";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    public function obtenerCantidadTotalPorInsumoEspecifico($id_insumo){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT id_insumo, SUM(cantidad) AS total_insumos 
                    FROM inventario 
                    WHERE cantidad > 0 AND id_insumo = '$id_insumo'
                    GROUP BY id_insumo";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

} 

?>
