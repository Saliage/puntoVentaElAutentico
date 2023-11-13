<?php

require_once('conexion.php');

class Promocion {

    // Agregar promoción
    public function agregarPromocion($nombre, $precio, $fecha_inicio, $fecha_fin) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "INSERT INTO promocion (nombre_promocion, precio, fecha_inicio, fecha_fin)
                     VALUES ('$nombre', '$precio', '$fecha_inicio', '$fecha_fin')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todas las promociones
    public function listarPromociones() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM promocion";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Buscar promoción por id
    public function buscarPromocionId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM promocion WHERE id_promocion = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Actualizar datos de promoción
    public function actualizarPromocion($id, $nombre, $precio, $fecha_inicio, $fecha_fin) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $nombre = mysqli_real_escape_string($conn, $nombre);

        $consulta = "UPDATE promocion SET
                    nombre_promocion = '$nombre',
                    precio = '$precio',
                    fecha_inicio = '$fecha_inicio',
                    fecha_fin = '$fecha_fin'
                    WHERE id_promocion = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar promoción por id
    public function eliminarPromocion($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM promocion WHERE id_promocion = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
