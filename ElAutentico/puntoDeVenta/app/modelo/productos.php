<?php

require_once('conexion.php');

class Trabajador {

    // Agregar trabajador
    public function agregarTrabajador($rut, $nombre, $apellido, $usuario, $clave, $activo, $rol_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "INSERT INTO trabajador (rut, nombre, apellido, usuario, clave, activo, rol_id_rol)
                     VALUES ('$rut', '$nombre', '$apellido', '$usuario', '$clave', '$activo', '$rol_id')";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Obtener todos los trabajadores
    public function listarTrabajadores() {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM trabajador";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    }

    // Buscar trabajador por id
    public function buscarTrabajadorId($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM trabajador WHERE id_trabajador = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    
    }

    // verificar sesion
    public function verificarTrabajador($usuario, $clave) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * FROM trabajador WHERE usuario = '$usuario' and clave = '$clave' and activo != 0";

        $resultado = $conn->query($consulta);

        return $resultado;
        $conn->close();
    
    }



    // Actualizar datos de trabajador
    public function actualizarTrabajador($id, $rut, $nombre, $apellido, $usuario, $clave, $activo, $rol_id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "UPDATE trabajador SET
                    rut = '$rut',
                    nombre = '$nombre',
                    apellido = '$apellido',
                    usuario = '$usuario',
                    clave = '$clave',
                    activo = '$activo',
                    rol_id_rol = '$rol_id'
                    WHERE id_trabajador = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }

    // Eliminar trabajador por id
    public function eliminarTrabajador($id) {
        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE FROM trabajador WHERE id_trabajador = '$id'";

        $resultado = $conn->query($consulta);

        return $resultado;
    }
}
?>
