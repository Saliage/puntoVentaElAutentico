<?php

require('conexion.php');

class Rol{

    
    public function obteberRol(){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "select * from rol";

        $resultado = $conn->query($consulta);

        return $resultado;

    }


    public function crearRol(String $rol){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "inster into rol (nombre_rol) values($rol)";

        $resultado = $conn->query($consulta);

        return $resultado;

    }




} 

?>