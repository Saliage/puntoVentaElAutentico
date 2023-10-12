<?php

require('conexion.php');

class Producto{

    
    public function obteberProductos(){

        $conectar = new Conexion();
        $conn = $conectar->abrirConexion();

        $consulta = "select * from producto";

        $resultado = $conn->query($consulta);

        return $resultado;

    }

} 

?>