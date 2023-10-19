<?php

require('conexion.php');

class Zona {

    // Agregar zona
    public function agregarZona($nombre, $almacen_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO zona (nombre_zona, almacen_id_almacen)
                     VALUES ('$nombre', '$almacen_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las zonas
    public function listarZonas() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM zona";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar zona por id
    public function buscarZonaId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM zona WHERE id_zona = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de zona
    public function actualizarZona($id, $nombre, $almacen_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE zona SET
                    nombre_zona = '$nombre',
                    almacen_id_almacen = '$almacen_id'
                    WHERE id_zona = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar zona por id
    public function eliminarZona($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM zona WHERE id_zona = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
