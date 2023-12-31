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
    <script src="../../public/js/inventario-administrador.js"></script>

    <title>Inventario administrador</title>

    <!-- ====================== ESTILOS CSS ==================== -->
    <link rel="stylesheet" href="../../public/css/ccs/carta-administrador.css">
    <!-- ====================== JS ==================== -->
    <script src="../../public/js/logOut.js"></script>
    <script src="../../public/js/scripts.js"></script>
    <script src="../../public/js/jquery-3.7.1.min.js"></script>
    <script src="../../public/js/js-maestro.js"></script>
    <script src="../../public/js/insumos-administrador.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>

<body onload="inicializar()">
 
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
                    <span class="link-icon-io"><ion-icon name="file-tray-stacked-outline"></ion-icon></i></span>
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
                <input type="search" placeholder="Buscar insumo">
                <ion-icon name="search" class="icono-busqueda"></ion-icon>
            </div>
            <div class="vendedor">
                <ion-icon name="person" class="icono-vendedor"></ion-icon>
                <span class="nombre-vendedor"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido'] ?></span>
            </div>
        </div>

        <div class="tabla-inventario" style="width: 100%;">

            <table class="table">
                <thead>
                    <div class="rounded-buttons-container">
                    <button class="boton-pagar" onclick="mostrarPopup()">Añadir insumo</button>
                    <button class="boton-pagar2" onclick="mostrarPopup2()">Categorias</button>
                    <button class="boton-pagar2" onclick="mostrarPopup8()">Formatos</button>
                    <p></p>   
                    </div>
                </thead>
                <tbody>                
                <div id="mostrarInsumos"></div>
                    
            </table>
        </div>
    </main>

<!----------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------                 GESTION INSUMOS                ------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------->  


    <div class="popup" id="popup">
        <div class="popup-contenido">
                <h2>Añadir insumo</h2>

                <form class="formulario" onsubmit="return agregarInsumo(event)" id="formInsumos" method="post" enctype="multipart/form-data">
                    <div class="form-element">
                    <label for="name">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre insumo" pattern=".{2,}" required>
                    </div>                
                    <div class="form-element">                    
                        <label for="id_categoria">Categoria:</label>
                        <div id="listarCategoria"></div>                    
                    </div>                
                    <div class="form-element">
                        <label for="perecible">Perecible</label>
                        <input type="checkbox" name="perecible" id="perecible">
                    </div>              
                    <div class="form-element">
                        <label for="id_formato">Formato:</label>
                        <div id="listarFormatos"></div>
                    </div>
                    <div class="form-element">
                        <label for="stock_minimo">Stock minimo:</label>
                        <input type="number" id="stock" name="stock">
                    </div>
                    <div class="form-element">
                        <label for="imagen">Imagen:</label>
                        <input type="file" name="imagen" id="imagen" accept=".jpg, .jpeg, .png">
                    </div>                
                    <input class="boton-pagar-mas" type="submit" name="agregar" value="Agregar">
                </form>
                

            <div class="cerrar-popup" onclick="cerrarPopup()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

<!----------------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------                 GESTION CATEGORIAS             -------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------->    

    <div class="popup" id="popup2">
        <div class="popup-contenido">
            <h2>Categorias</h2>

            <div class="formulario" id="formAlmacenes">
                <div>
                    <label for="nombreCategoriaTxt">Nombre:</label>
                    <input type="text" name="nombre" id="nombreCategoriaTxt" pattern=".{5,}"  required>
                </div>
                <button type="submit" onclick="agregarCategoria();"><ion-icon name="add-circle-outline" ></ion-icon></button>
            </div>
            <hr>
                <tbody>
                    <div id="verCategorias"></div>
                </tbody>
            </table>
            <div class="cerrar-popup" onclick="cerrarPopup2()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

<!----------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------                GESTION FORMATOS              -------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="popup" id="popup8">
        <div class="popup-contenido">
            <h2>Formatos</h2>
            
            <form class="formulario" onsubmit="return agregarFormato(event)" id="formFormatos" method="post">
                <div>
                    <label for="nombreFormatoTxt">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" autocomplete="off" placeholder="Nombre" pattern=".{2,}" title="Al menos 2 caracteres"  required>
                
                    <input type="submit" value="Guardar">
                </div>
            </form>
            <hr>
                <tbody>
                    <div id="verFormatos"></div>
                </tbody>
            </table>
            <div class="cerrar-popup" onclick="cerrarPopup8()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

</body>
</html>