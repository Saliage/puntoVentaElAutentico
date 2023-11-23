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

    <title>Carta administrador</title>
    <!-- ====================== ESTILOS CSS ==================== -->
    <link rel="stylesheet" href="../../public/css/ccs/carta-administrador-carta.css">
    <link rel="stylesheet" href="../../public/css/ccs/carta-administrador.css">
    <!-- ====================== JS ==================== -->
    <script src="../../public/js/scripts.js"></script>
    <script src="../../public/js/jquery-3.7.1.min.js"></script>
    <script src="../../public/js/js-maestro.js"></script>
    <script src="../../public/js/logOut.js"></script>
    <script src="../../public/js/carta.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>

<body  onload="inicializar()">
 
    <!-- -------- BARRA DE NAVEGACION ------- -->
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="logo">
                <a href="../../app/vistas/carta-administrador.php" class="nav-link-menu" placeholder="holactm">
                    <span class="link-icon"><ion-icon name="menu-outline"></ion-icon></i></span>
                    <span class="link-text">Menu</span>
                </a>
            </li>

            <!-- -------- ITEMS DE BARRA DE NAVEGACION ------- -->
            <li class="nav-item">
                <a href="../../app/vistas/carta-administrador.php" class="nav-link">
                    <span class="link-icon-io"><ion-icon name="fast-food-outline"></ion-icon></i></span>
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
                    <span class="link-icon"><ion-icon name="body"></ion-icon></i></span>
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
                <input type="search" placeholder="Buscar producto">
                <ion-icon name="search" class="icono-busqueda"></ion-icon>
            </div>
            <div class="vendedor">
                <ion-icon name="person" class="icono-vendedor"></ion-icon>
                <span class="nombre-vendedor"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido'] ?></span>
            </div>
        </div>

        <div class="tabla-inventario">
            <table class="table">
                <div class="fixed">
                    <thead class="contenedor-datos">
                        <div class="rounded-buttons-container">
                            <button class="boton-pagar" onclick="mostrarPopup()">Añadir producto</button>
                            <button class="boton-pagar2" onclick="mostrarPopup2()">Categorias</button>
                            <p></p>   
                        </div>
                    </thead>
                    <tbody>
                        <div id="mostrarProductos"></div> <!-- div que mostrará el contenido del ajax -->
                    </tbody>
                </div>
            </table>
        </div>
    </main>

    <!------------------------------------------------------------------->
    <!-- Contenedor del popup AÑADIR PRODUCTOS (inicialmente oculto) ----->
    <!------------------------------------------------------------------->

    <div class="popup" id="popup">
        <div class="popup-contenido">
            <h2>Agregar producto:</h2>
            <p></p>
            <form id="formAgregarProductos" onsubmit="return agregarProductos(event)" method="post" class="formulario">

            <div class="form-element">
                <label for="nombre_producto">Nombre:</label>
                <input type="text" name="nombre_producto" id="nombre_producto" autocomplete="off"  placeholder="Ej: Coca-Cola, Italiano Gigante, etc" required>
            </div>

            <div class="form-element">
                <label for="codigo_producto">Codigo de barras:</label>
                <input type="number" name="codigo_producto" id="codigo_producto" autocomplete="off" minlength="7" maxlength="25" placeholder="Codigo de barras, Ej: 123456789234">
            </div>

            <div class="form-element">
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept=".jpg, .jpeg, .png">
            </div>  
            
            <div class="form-element">
                <label for="listarTipoDIV">Tipo de Producto:</label>
                <div id="listarTipoDIV" ></div> <!-- listar Categorias de los productos en combobox -->
            </div>

            <div class="form-element">
                <label for="costo_unitario">Costo unitario:</label>
                <input type="number" name="costo_unitario" id="costo_unitario" autocomplete="off" minlength="3" maxlength="5" placeholder="Ej: 1500" required>
            </div>

            <div class="form-element">
                <label for="precio_venta">Precio venta:</label>
                <input type="number" name="precio_venta" id="precio_venta" autocomplete="off" minlength="3" maxlength="5" placeholder="Ej: 2000" required>
            </div>

            <div class="form-element">
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion" autocomplete="off"  placeholder="(Opcional) Breve descripción del producto)">
            </div>
            <div class="form-element">
                <label for="disponible">Disponible:</label>
                <input type="checkbox" id="disponible" name="disponible">
            </div>

            
            <p></p>

            <input class="boton-pagar-mas" type="submit" name="agregar">

            </form>
                                
            <div class="cerrar-popup" onclick="cerrarPopup()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

    <!------------------------------------------------------------------->
    <!-- Contenedor del popup MOSTRAR CATEGORIAS (inicialmente oculto) -->
    <!------------------------------------------------------------------->

    <div class="popup" id="popup2">
        <div class="popup-contenido">
            <h2>Categorias</h2>
            
            <form class="formulario" onsubmit="return agregarTiposP(event)" id="formCat" method="post">
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" autocomplete="off" placeholder="Nombre" pattern=".{2,}" title="Al menos 2 caracteres"  required>
                
                    <input type="submit" value="Guardar">
                </div>
            </form>
            <hr>
                <tbody>
                    <div id="verTipoP"></div>
                </tbody>
            </table>
            <div class="cerrar-popup" onclick="cerrarPopup2()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>
</body>
</html>