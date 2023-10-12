<?php

class Conexion{

    private $host = "localhost";
    private $user = "root";
    private $password = "161192-4";
    private $database = "autentico";
    private $port = 3307;

    public function abrirConexion(){
        $conn = mysqli_connect($host, $user, $password, $database, $port);    
        return $conn;
    }

    public function cerrarConexion(){
        
        $conexion = abrirConexion();
        mysqli_close($conexion);

    }

}