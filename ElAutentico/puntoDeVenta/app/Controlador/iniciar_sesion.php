<?php

require_once("../modelo/trabajador.php");
session_start();
ob_start();

$_SESSION['sesion'] = 0; // variable sin cambios, para rechazar todas las conexiones
                            // 0 sin sesion iniciada
                            // 1 conexion exitosa (sesion iniciada)
                            // 2 controlar campos vacios (si magicamente se saltan la validación del formulario)
                            // 3 datos erroneos (usuario o clave invalida)
                            // 4 cierre de sesion por parte del usuario.


//preparar variables de usuarios para control y uso global

$_SESSION['id'] = null;
$_SESSION['rol'] = null;
$_SESSION['usuario'] = null; 
$_SESSION['nombre'] = null;
$_SESSION['apellido'] = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") { //validar que el acceso no sea mediante URL

    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $llave = $_POST['llave'];


    if($usuario == "" || $clave =="")
    {
        $_SESSION['sesion'] = 2; // datos vacios
    }
    else
    {   
        $_SESSION['sesion'] = 3; // se asume datos erroneos, hasta confirmar con BD   

        $trabajador = new Trabajador();
        try {
            $resultado = $trabajador->verificarTrabajador($usuario,$clave);
        } catch (Exception $e) {
            // Manejar la excepción si ocurre algún error en verificarTrabajador
            echo "Error: " . $e->getMessage();
            //exit; // O realiza alguna acción adicional, según tu necesidad
        }
        
        if ($consulta = mysqli_fetch_array($resultado)) {
        
            $_SESSION['id'] = $consulta['id_trabajador'];
            $_SESSION['rol'] = $consulta['rol_id_rol'];
            $_SESSION['usuario'] = $consulta['usuario'];
            $_SESSION['nombre'] = $consulta['nombre'];
            $_SESSION['apellido'] = $consulta['apellido'];

            $_SESSION['sesion'] = 1; // se confirma inicio de sesion, se cambia el estado
        }
               
    }
    
    //Verifica si se solicitó cierre de sesion
    if($llave == "cerrar"){

        $_SESSION['sesion'] = 4; 
    }

    //redireccionar o mostrar mensaje según el estado de sesión

    if ($_SESSION['sesion'] == 1) {
        echo 'OK';
    } elseif ($_SESSION['sesion'] == 0) {
        echo 'Inicie sesión';
    } elseif ($_SESSION['sesion'] == 2) {
        echo 'Los campos son obligatorios';
    } elseif ($_SESSION['sesion'] == 3) {
        echo 'Usuario o clave incorrectos';
    } elseif ($_SESSION['sesion'] == 4) {
        echo 'Cerrar';
        $_SESSION['sesion'] = 0;
    }
               
}
else
{
    //redireccionar en caso de no llegar a la pagina como corresponde
    header('Location: ../vistas/login.html'); 
    die();

}
?>