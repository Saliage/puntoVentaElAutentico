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
    public function CantidadTotalPorInsumo(){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT id_insumo, SUM(cantidad) AS total_insumos 
                    FROM inventario 
                    WHERE cantidad > 0 
                    GROUP BY id_insumo";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    public function TotalPorInsumoEspecifico($id_insumo){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT id_insumo, SUM(cantidad) AS total_insumos 
                    FROM inventario 
                    WHERE cantidad > 0 AND id_insumo = '$id_insumo'
                    GROUP BY id_insumo";

        $resultado = $conn->query($consulta);

        return $resultado;
    }



    // Función para obtener información de productos en inventario con stock total
    function inventarioInnerJoin()
    {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();
        
        $consulta = "SELECT
                        i.id_insumo as id,
                        i.imagen as imagen,
                        i.nombre_insumo as nombre,
                        SUM(i.cantidad) AS stock_total,
                        c.nombre_categoria as categoria,
                        f.nombre_formato as formato,
                        i.perecible as perecible
                    FROM inventario i INNER JOIN categoria_insumo c ON i.categoria_insumo_id_categoria = c.id_categoria
                    INNER JOIN formato f ON i.formato_id_formato = f.id_formato
                    WHERE i.cantidad > 0
                    GROUP BY i.id_insumo";

        $resultado = $conn->query($consulta);

        return $resultado;
    }






}
