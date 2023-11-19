<?php

require_once('conexion.php');

class Inventario{

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // agregar registro de inventario
    public function agregarRegistro($id_insumo, $cantidad, $costo_unitario, $fecha_vencimiento, $id_zona, $id_trabajador) {

        $respuesta = $this->insertarMovimientoInsumo($id_trabajador,1); //registra movimiento para luego registrar inventario
        if($respuesta["resultado"] === true) {

            $id_mov = $respuesta["id_movimiento"];
            $sql="";

            if($fecha_vencimiento == null){ //inseta sin fecha de vencimiento para insumos no perecibles

                $sql = $this->conn->prepare("INSERT INTO inventario (id_insumo, cantidad, costo_unitario, id_zona, id_movimiento) 
                                            VALUES (?, ?, ?, ?, ?)");
            
                $sql->bind_param("iidii", $id_insumo, $cantidad, $costo_unitario, $id_zona, $id_mov);

            } else {
                $sql = $this->conn->prepare("INSERT INTO inventario (id_insumo, cantidad, costo_unitario, fecha_vencimiento, id_zona, id_movimiento) 
                                            VALUES (?, ?, ?, ?, ?, ?)");

                $sql->bind_param("iidsii", $id_insumo, $cantidad, $costo_unitario, $fecha_vencimiento, $id_zona, $id_mov);
            }

            $resultado = $sql->execute();
            $sql->close();

            return $resultado;

        }
        
    }    

    public function insertarMovimientoInsumo($idTrabajador, $idTipoMovimiento) {
          
        $sql = $this->conn->prepare("INSERT INTO movimiento_insumo (fecha, id_trabajador, id_tipo_mov) VALUES (NOW(), ?, ?)");
        $sql->bind_param("ii", $idTrabajador, $idTipoMovimiento);
    
        $resultado = $sql->execute();
    
        // rescatar id auto incremental para poder guardar 
        $id_movimiento = $this->conn->insert_id;
    
        $sql->close();
    
        // crear arreglo para enviar id y resultado de la consulta
        return array("resultado" => $resultado, "id_movimiento" => $id_movimiento);
    }
    

    // Obtener todos los registros de inventario
    public function listarRegistros() {

        $consulta = "SELECT * FROM inventario";
        $resultado = $this->conn->query($consulta);

        return $resultado;
    }


    // Actualizar datos de registro de inventario
    public function actualizarRegistro($numero_registro, $id_insumo, $id_movimiento, $cantidad, $costo_unitario, $fecha_vencimiento, $id_zona) {
        $sql = $this->conn->prepare("UPDATE inventario SET 
                                    id_insumo = ?, 
                                    id_movimiento = ?, 
                                    cantidad = ?, 
                                    costo_unitario = ?, 
                                    fecha_vencimiento = ?, 
                                    id_zona = ? 
                                    WHERE numero_registro = ?");

        $sql->bind_param("iiidsii", $id_insumo, $id_movimiento, $cantidad, $costo_unitario, $fecha_vencimiento, $id_zona, $numero_registro);

        $resultado = $sql->execute();
        $sql->close();
        return $resultado;
    }
    // Obtener los datos de insumos disponibles, ordenados por fecha de vencimiento según el insumo especifico
    public function obtenerInsumosPorFecha($id_insumo) {

        $sql = $this->conn->prepare("SELECT id_insumo, cantidad, costo_unitario, fecha_vencimiento 
                                    FROM inventario 
                                    WHERE cantidad > 0 AND id_insumo = ? 
                                    ORDER BY fecha_vencimiento ASC");

        $sql->bind_param("i", $id_insumo);
        $sql->execute();

        $resultado = $sql->get_result();
        $sql->close();

        return $resultado;
    }

    // Obtener la cantidad de insumos disponibles por cada insumo
    public function CantidadTotalPorInsumo() {

        $consulta = "SELECT id_insumo, SUM(cantidad) AS total_insumos 
                    FROM inventario 
                    WHERE cantidad > 0 
                    GROUP BY id_insumo";

        $resultado = $this->conn->query($consulta);


        return $resultado;
    }

    public function TotalPorInsumoEspecifico($id_insumo) {

        $sql = $this->conn->prepare("SELECT id_insumo, SUM(cantidad) AS total_insumos 
                                     FROM inventario 
                                     WHERE cantidad > 0 AND id_insumo = ? 
                                     GROUP BY id_insumo");

        $sql->bind_param("i", $id_insumo);
        $sql->execute();

        $resultado = $sql->get_result();
        $sql->close();


        return $resultado;
    }

    // Función para obtener información de productos en inventario con stock total
    function inventarioInnerJoin() {

        $sql = $this->conn->prepare("SELECT inv.id_insumo as id, ins.imagen as imagen, ins.nombre_insumo as nombre, SUM(inv.cantidad) AS stock_total, 
                                    cat.nombre_categoria as categoria, f.nombre_formato as formato, ins.perecible as perecible
                                    FROM inventario inv 
                                    INNER JOIN insumos ins ON inv.id_insumo = ins.id_insumo
                                    INNER JOIN categoria_insumo cat ON cat.id_categoria = ins.categoria_insumo_id_categoria
                                    INNER JOIN formato f ON ins.formato_id_formato = f.id_formato
                                    WHERE inv.cantidad > 0
                                    GROUP BY inv.id_insumo");
    
        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();
    
        return $resultado;
    }






}
