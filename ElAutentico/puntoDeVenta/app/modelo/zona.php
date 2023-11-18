<?php

require_once('conexion.php');

class Zona {

    // Agregar zona
    public function agregarZona($nombre, $almacen_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO zona (nombre_zona, almacen_id_almacen)
                     VALUES ('$nombre', '$almacen_id')";

        $resultado = $conn->query($consulta);
        
        return $resultado;
        $conn ->close();
    }

    // Obtener todas las zonas
    public function listarZonas() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM zona";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn ->close();
    }

    // Buscar zona por id
    public function buscarZonaId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM zona WHERE id_zona = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn ->close();
    }

    // listar zonas según almacen
    public function buscarZonaPorAlmacen($id_almacen){
        
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM zona WHERE almacen_id_almacen = '$id_almacen'";

        $resultado = $conn->query($consulta);
        return $resultado;
        $conn ->close();
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
        $conn ->close();
    }

    // Eliminar zona por id
    public function eliminarZona($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM zona WHERE id_zona = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn ->close();
    }
}
?>
