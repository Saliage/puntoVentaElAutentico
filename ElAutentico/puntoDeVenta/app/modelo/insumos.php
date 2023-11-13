<?php

require_once('conexion.php');

class Insumos {

    // Agregar insumo
    public function agregarInsumo($nombre_insumo, $perecible, $fecha_vencimiento, $stock_total, $costo, $categoria_id, $formato_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre_insumo = mysqli_real_escape_string($conn, $nombre_insumo);

        $consulta = "INSERT INTO insumos (nombre_insumo, perecible, fecha_vencimiento, stock_total, costo, categoria_insumo_id_categoria, formato_id_formato)
                     VALUES ('$nombre_insumo', '$perecible', '$fecha_vencimiento', '$stock_total', '$costo', '$categoria_id', '$formato_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los insumos
    public function listarInsumos() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM insumos";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar insumo por id
    public function buscarInsumoId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM insumos WHERE id_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de insumo
    public function actualizarInsumo($id, $nombre_insumo, $perecible, $fecha_vencimiento, $stock_total, $costo, $categoria_id, $formato_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre_insumo = mysqli_real_escape_string($conn, $nombre_insumo);

        $consulta = "UPDATE insumos SET
                    nombre_insumo = '$nombre_insumo',
                    perecible = '$perecible',
                    fecha_vencimiento = '$fecha_vencimiento',
                    stock_total = '$stock_total',
                    costo = '$costo',
                    categoria_insumo_id_categoria = '$categoria_id',
                    formato_id_formato = '$formato_id'
                    WHERE id_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar insumo por id
    public function eliminarInsumo($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM insumos WHERE id_insumo = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
