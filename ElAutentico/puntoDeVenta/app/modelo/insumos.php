<?php

require('conexion.php');

class Insumos {

    // Agregar insumo
    public function agregarInsumo($nombre, $formato, $perecible, $fecha_vencimiento, $cantidad, $formato_id, $categoria_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO insumos (nombre_insumo, formato, perecible, fecha_vencimiento, cantidad, formato_id_formato, categoria_insumo_id_categoria)
                     VALUES ('$nombre', '$formato', '$perecible', '$fecha_vencimiento', '$cantidad', '$formato_id', '$categoria_id')";

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
    public function actualizarInsumo($id, $nombre, $formato, $perecible, $fecha_vencimiento, $cantidad, $formato_id, $categoria_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);
        $formato = mysqli_real_escape_string($conn, $formato);

        $consulta = "UPDATE insumos SET
                    nombre_insumo = '$nombre',
                    formato = '$formato',
                    perecible = '$perecible',
                    fecha_vencimiento = '$fecha_vencimiento',
                    cantidad = '$cantidad',
                    formato_id_formato = '$formato_id',
                    categoria_insumo_id_categoria = '$categoria_id'
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
