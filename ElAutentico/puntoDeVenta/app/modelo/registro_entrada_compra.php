<?php

require_once('conexion.php');

class RegEntradaCompra {

    // Agregar registro de entrada por compra
    public function agregarRegEntradaCompra($compra_id, $fecha) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO reg_entrada_compra (compra_id_compra, fecha)
                     VALUES ('$compra_id', '$fecha')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los registros de entrada por compra
    public function listarRegEntradaCompra() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM reg_entrada_compra";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar registro de entrada por compra por id
    public function buscarRegEntradaCompraId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM reg_entrada_compra WHERE id_reg_entrada_compra = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    
    }

    // Actualizar datos de registro de entrada por compra
    public function actualizarRegEntradaCompra($id, $compra_id, $fecha) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE reg_entrada_compra SET
                    compra_id_compra = '$compra_id',
                    fecha = '$fecha'
                    WHERE id_reg_entrada_compra = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar registro de entrada por compra por id
    public function eliminarRegEntradaCompra($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM reg_entrada_compra WHERE id_reg_entrada_compra = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}

?>
