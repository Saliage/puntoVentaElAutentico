<?php

class Conexion {

    private $host = "localhost";
    private $user = "root";
    private $password = "161192-4";
    private $database = "autentico";
    private $port = 3307;

    public function abrirConexion(){ 
        
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database, $this->port);

        // Verificar la conexión
        if (!$conn) {
            die("La conexión falló: " . mysqli_connect_error());
        }

        return $conn;
    }

    public function cerrarConexion() {
        // Verificar si la conexión está abierta antes de intentar cerrarla
        if ($this->conn instanceof mysqli) {
            $this->conn->close();
        }

}

?>