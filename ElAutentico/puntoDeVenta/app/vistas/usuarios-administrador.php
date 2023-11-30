<?php 
    session_start();
    ob_start();

    if($_SESSION['sesion'] <>1)
    {
      header('Location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../public/imagenes/LogoFoodTruck.jpg">

    <title>Administracion de usuarios</title>
    <!-- ====================== ESTILOS CSS ==================== -->
    <link rel="stylesheet" href="../../public/css/ccs/carta-administrador.css">
    <!--Import materialize.css
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/> -->
    <!-- ====================== JS ==================== -->
    <script src="../../public/js/usuario-administrador.js"></script>
    <script src="../../public/js/jquery-3.7.1.min.js"></script>
    <script src="../../public/js/js-maestro.js"></script>
    <script src="../../public/js/logOut.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    
</head>

    <body  onload="inicializar()">
 
        <!-- -------- BARRA DE NAVEGACION ------- -->
            <nav class="navbar">
                <ul class="navbar-nav">
                    <li class="logo">
                        <a href="../../app/vistas/carta-administrador.php" class="nav-link-menu">
                            <span class="link-icon"><ion-icon name="menu-outline"></ion-icon></i></span>
                            <span class="link-text">Menu</span>
                        </a>
                    </li>

                    <!-- -------- ITEMS DE BARRA DE NAVEGACION ------- -->
                    <li class="nav-item">
                        <a href="../../app/vistas/carta-administrador.php" class="nav-link">
                            <span class="link-icon"><ion-icon name="fast-food-outline"></ion-icon></i></span>
                            <span class="link-text">Carta</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../app/vistas/inventario-administrador.php" class="nav-link">
                            <span class="link-icon"><ion-icon name="clipboard-outline"></ion-icon></i></span>
                            <span class="link-text">Inventario</span>
                        </a>
                    </li>
                    <li class="nav-item">
                         <a href="../../app/vistas/insumos-administrador.php" class="nav-link">
                             <span class="link-icon"><ion-icon name="file-tray-stacked-outline"></ion-icon></i></span>
                             <span class="link-text">Insumos</span>
                         </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../app/vistas/hist_ventas-administrador.php" class="nav-link">
                            <span class="link-icon"><ion-icon name="book-outline"></ion-icon></i></span>
                            <span class="link-text">Historial Ventas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../app/vistas/usuarios-administrador.php" class="nav-link">
                            <span class="link-icon-io"><ion-icon name="body"></ion-icon></i></span>
                            <span class="link-text">Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../app/vistas/reporte_ventas-administrador.php" class="nav-link">
                            <span class="link-icon"><ion-icon name="document"></ion-icon></i></span>
                            <span class="link-text">Reporte Ventas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../app/vistas/carta-vendedor.php" class="nav-link">
                            <span class="link-icon"><ion-icon name="person-outline"></ion-icon></i></span>
                            <span class="link-text">Vista vendedor</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="confirmarCerrarSesion();">
                            <span class="link-icon"><ion-icon name="log-in-outline"></ion-icon></i></span>
                            <span class="link-text">Cerrar Sesión</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <!-- Contenido principal que deseas desenfocar -->
        <main class="contenido-a-desenfocar">

            <!-- Barra de busqueda y usuario -->
            <div class="barra-busqueda">
                <div class="entrada-busqueda">
                    <input type="text" placeholder="Buscar usuario">
                    <ion-icon name="search" class="icono-busqueda"></ion-icon>
                </div>
                <div class="vendedor">
                    <ion-icon name="person" class="icono-vendedor"></ion-icon>
                    <span class="nombre-vendedor"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido'] ?></span>
                </div>
            </div>
            <div class="tabla-inventario">

                <table class="table">
                    <thead class="contenedor-datos">
                        <div class="rounded-buttons-container">
                            <button class="boton-pagar" onclick="mostrarPopup()">Añadir usuario</button>  
                            <button class="boton-pagar2" onclick="mostrarPopup2()">Roles</button>         
                            <p></p>                 
                        </div>  
                    </thead>
                    <tbody>
                        <div id="mostrarTrabajadores"></div> <!-- div que mostrará el contenido del ajax -->
                    </tbody>
                </table>
            </div>
        </main>
        <!-- El contenedor del popup (inicialmente oculto) -->
        <div class="popup" id="popup">
            <div class="popup-contenido">
                <h2>Añadir usuario:</h2>
                <p></p>
                <form id="formAgregarTrabajador" onsubmit="return agregarTrabajador(event)" method="post">
                
                <div id="validaRUT" style="color: red;"></div>    
                <div class="form-element">
                    <label for="rut">Rut:</label>
                    <input type="text" name="rut" id="rut" autocomplete="off" oninput="validarRutTxt()" placeholder="12345678-9" minlength="9" maxlength="10"  pattern="^[0-9]+-[0-9kK]$|^[0-9]+[kK]-[0-9]$"  title="Rut con sin puntos y con guion" required>                    
                </div>                
                <div class="form-element">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" autocomplete="off" placeholder="Ej: Juan" required>
                </div>                
                    
                <div class="form-element"><label for="apellido">Apellidos:</label>
                    <input type="text" name="apellido" id="apellido" autocomplete="off" placeholder="Ej: Riquelme Palma" required>
                </div>

                <div class="form-element">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" autocomplete="off" placeholder="Ej: Riquelme Palma" required>
                </div>

                <div class="form-element">
                    <label for="clave">Contraseña:</label>
                    <input type="password" name="clave" id="clave" minlength="8"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"  title="Debe contener al menos 8 caracteres con al menos una letra mayúscula y una letra minúscula y al menos un número"  
                    name="clave" placeholder="Contraseña" required>
                </div>
                    
                <div id="mostrarRoles" class="form-element"> <!-- listar roles en combobox -->
                <p></p>
                </div>
                <p></p>
                <button class="boton-pagar-mas" type="submit" name="agregar"> <ion-icon name="add-circle-outline"></ion-icon> </button>  
                </form>
                
                <div class="cerrar-popup" onclick="cerrarPopup()"><ion-icon name="close-circle"></ion-icon></div>
            </div>
        </div>


        <!--------------------------------------------------------------------------------------------------------------------------------------->
        <!----------------------------------------------             MOSTRAR ROLES                ----------------------------------------------->
        <!--------------------------------------------------------------------------------------------------------------------------------------->


        <div class="popup" id="popup2">
            <div class="popup-contenido">
                <h2>Roles</h2>
                <div class="formulario">
                    <hr>
                    <div class="row text-center">
                        <div class="col">
                            <label  class="label-crear-roles for="buscador">Nuevo ROL: </label>
                            <input  class="input-crear-roles" type="text" name="buscador" id="buscador" class="form-control">
                            <button class="boton-agregar-roles" type="submit" name="agregar" value="Agregar Rol" onclick="gestionarRol(1);"  onmouseout="gestionarRol(2);"><ion-icon name="add-circle-outline"></ion-icon></button>              
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">		
                        <div class="col-md-8">
                            <div id="mostrar_mensaje"></div> <!-- div que mostrará el contenido del ajax -->
                        </div>
                    </div>
                </div>
                    
                <div class="cerrar-popup" onclick="cerrarPopup2()"><ion-icon name="close-circle"></ion-icon></div>
            </div>  
                
        </div>

    </body>
   
</html>