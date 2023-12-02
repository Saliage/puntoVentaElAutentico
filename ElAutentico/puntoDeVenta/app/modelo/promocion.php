<?php

require_once('conexion.php');

class Promocion {

    private $conn;

    public function __construct() {
        $conectar = new Conexion();
        $this->conn = $conectar->abrirConexion();
    }

    // Agregar promoción
    public function agregarPromocion($nombre, $precio, $fecha_inicio, $fecha_fin, $productos) {

        if($fecha_fin ==''){

            $consulta = "INSERT INTO promocion (nombre_promocion, precio, fecha_inicio )
            VALUES (?, ?, ?)";

            $sql = $this->conn->prepare($consulta);
            $sql->bind_param("sds", $nombre, $precio, $fecha_inicio);

        }
        else{

            $consulta = "INSERT INTO promocion (nombre_promocion, precio, fecha_inicio, fecha_fin)
            VALUES (?, ?, ?, ?)";

            $sql = $this->conn->prepare($consulta);
            $sql->bind_param("sdss", $nombre, $precio, $fecha_inicio, $fecha_fin);
        }       

        $resultado = $sql->execute();

        $id_promo = $this->conn->insert_id; //rescatar el id de la ultima insercion
        $sql->close();

        foreach($productos as $prod){

            $consulta = "INSERT INTO producto_promocion (promocion_id_promocion, producto_id_producto, cantidad ) VALUES (?, ?, ?)";
            $sql = $this->conn->prepare($consulta);
            $sql->bind_param("iii", $id_promo, $prod['prod'], $prod['cantidad']);
            $resultado = $sql->execute();

        }
        $this->conn->close();

        return $resultado;
    }

    // Obtener todas las promociones
    public function listarPromociones() {
        $consulta = "SELECT * FROM promocion ";

        $resultado = $this->conn->query($consulta);

        return $resultado;
    }

    // Buscar promoción por id
    public function detallePromocionId($id) {
        $consulta = "SELECT p.id_promocion AS id,pro.nombre_producto AS producto, pp.cantidad
                    FROM promocion p INNER JOIN producto_promocion pp ON pp.promocion_id_promocion = p.id_promocion
                    INNER JOIN producto pro ON pro.id_producto = pp.producto_id_producto 
                    WHERE p.id_promocion = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $sql->execute();
        $resultado = $sql->get_result();

        $sql->close();

        return $resultado;
    }

    // Actualizar datos de promoción
    public function actualizarPromocion($id, $nombre, $precio, $fecha_inicio, $fecha_fin) {
        $consulta = "UPDATE promocion SET
                    nombre_promocion = ?,
                    precio = ?,
                    fecha_inicio = ?,
                    fecha_fin = ?
                    WHERE id_promocion = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("sdssi", $nombre, $precio, $fecha_inicio, $fecha_fin, $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }

    // Eliminar promoción por id
    public function eliminarPromocion($id) {
        $consulta = "DELETE FROM promocion WHERE id_promocion = ?";

        $sql = $this->conn->prepare($consulta);
        $sql->bind_param("i", $id);

        $resultado = $sql->execute();

        $sql->close();
        $this->conn->close();

        return $resultado;
    }
}
?>
