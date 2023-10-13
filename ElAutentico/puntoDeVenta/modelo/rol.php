<?php

require('conexion.php');

class Rol{

    //listar roles
    public function obteberRol(){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "select * from rol";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

    //crear rol
    public function crearRol($nombreRol) {

        $conexion = new Conexion();
        $conn = $conexion->abrirConexion();

        $nombreRol = mysqli_real_escape_string($conn, $nombreRol);

        //consulta SQL
        $query = "INSERT INTO rol (nombre_rol) VALUES ('$nombreRol')";

        try {
            // Ejecutar la consulta
            $result = $conn->query($query);

            if ($result) {
                echo "Rol creado exitosamente.";
            } else {
                throw new Exception("Error al ejecutar la consulta: " . $conn->error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        // Cerrar la conexión
        $conexion->cerrarConexion();
    }

    public function buscarRol($id_rol){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "SELECT * from rol WHERE id_rol ='$id_rol'";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

    public function borrarRol($id_rol){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "DELETE from rol WHERE id_rol ='$id_rol'";

        $resultado = $conn->query($consulta);

        return $resultado;

    }


} 

?>