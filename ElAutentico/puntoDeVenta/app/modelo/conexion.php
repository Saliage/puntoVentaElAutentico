<?php

class Conexion {

    private $host = "localhost";
    private $user = "root";
    private $password = "161192-4";
    private $database = "autentico";
    private $port = 3307;
    private $conn;

    public function abrirConexion(){ 
        
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database, $this->port);

        // Verificar la conexión
        if (!$this->conn) {
            die("La conexión falló: " . mysqli_connect_error());
        }

        return $this->conn;
    }

    public function cerrarConexion() {
        // Verificar si la conexión está abierta antes de intentar cerrarla
        if ($this->conn instanceof mysqli) {
            mysqli_close($this->conn);
        }
    }

}

?>