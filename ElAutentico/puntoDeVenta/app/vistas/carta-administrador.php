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
    <link rel="stylesheet" href="../../public/css/ccs/carta-administrador.css">
    <!-- ====================== JS ==================== -->
    <script src="../../public/js"></script>
    <script src="../../public/js/scripts.js"></script>
    <script src="../../public/js/jquery-3.7.1.min.js"></script>
    <script src="../../public/js/js-maestro.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>

<body>
 
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
                    <thead>
                        <button class="boton-pagar" onclick="mostrarPopup()">Añadir producto</button>
                        <button class="boton-pagar2" onclick="mostrarPopup2()">Categorias</button>
                        <p></p>   
                        <tr class="fila-titulos">
                            <th></th>
                            <th>Nombre</th>
                            <th>Id producto</th>
                            <th>Codigo</th>
                            <th>Categoria</th>
                            <th>Precio costo</th>
                            <th>Precio venta</th>
                            <th colspan="3"> </th> 
                        </tr>
                    </thead>
                </div>
                <tbody>
                    <tr>
                        <td> <img src="../../public/imagenes/completo-italiano.jpg"></td>
                        <td>Completo</td>
                        <td>001</td>
                        <td>757483383930</td>
                        <td>Hot Dogs</td>
                        <td>$950</td>
                        <td>1.300</td>
                        <td></td>
                        <td><ion-icon name="pencil-outline" class="icono-editar"></ion-icon></td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td> <img src="../../public/imagenes/completo-italiano.jpg"></td>
                        <td>Completo</td>
                        <td>001</td>
                        <td>757483383930</td>
                        <td>Hot Dogs</td>
                        <td>$950</td>
                        <td>$1.300</td>
                        <td></td>
                        <td><ion-icon name="pencil-outline" class="icono-editar"></ion-icon></td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td> <img src="../../public/imagenes/completo-italiano.jpg"></td>
                        <td>Completo</td>
                        <td>001</td>
                        <td>757483383930</td>
                        <td>Hot Dogs</td>
                        <td>$950</td>
                        <td>$1.300</td>
                        <td></td>
                        <td><ion-icon name="pencil-outline" class="icono-editar"></ion-icon></td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td> <img src="../../public/imagenes/completo-italiano.jpg"></td>
                        <td>Completo</td>
                        <td>001</td>
                        <td>757483383930</td>
                        <td>Hot Dogs</td>
                        <td>$950</td>
                        <td>$1.300</td>
                        <td></td>
                        <td><ion-icon name="pencil-outline" class="icono-editar"></ion-icon></td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td>  
                    </tr>
                    <tr>
                        <td> <img src="../../public/imagenes/completo-italiano.jpg"></td>
                        <td>Completo</td>
                        <td>001</td>
                        <td>757483383930</td>
                        <td>Hot Dogs</td>
                        <td>$950</td>
                        <td>$1.300</td>
                        <td></td>
                        <td><ion-icon name="pencil-outline" class="icono-editar"></ion-icon></td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <!-- El contenedor del popup añadir producto (inicialmente oculto) -->
    <div class="popup" id="popup">
        <div class="popup-contenido">
            <h2>Agregar producto:</h2>
            <p></p>
            <form action="" method="POST" class="formulario">
                <div class="form-element">
                  <label for="name">Nombre:</label>
                  <input type="text" name="nombre" placeholder="Nombre producto" required>
                </div>
                
                <div class="form-element">
                  <label for="Id">Id:</label>
                  <input type="number" min="1" name="id" placeholder="Id producto" required>
                </div>

                <div class="form-element">
                    <label for="Id">Imagen</label>
                    <input type="file" max="1" accept="image/*" name="imagen" placeholder="imagen" required>
                  </div>

                <div class="form-element">
                    <label for="Id">Codigo:</label>
                    <input type="number" min="1" name="codigo" placeholder="Codigo producto" required>
                </div>

                <div class="form-element">
                    <label for="cat-producto">Categoria:</label>
                    <select id="cat-producto" name="cat-producto" required>
                      <option value="Hot Dogs">Hot Dogs</option>
                      <option value="Bebidas">Bebidas</option>
                      <option value="Frituras">Frituras</option>
                    </select>
                </div>

                <div class="form-element">
                    <label for="costo">Precio costo:</label>
                    <input type="number" min="100" name="p-costo" placeholder="Precio costo" required>
                </div>

                <div class="form-element">
                    <label for="costo">Precio venta:</label>
                    <input type="number" min="100" name="p-venta" placeholder="Precio Venta" required>
                </div>

                <p></p>

                <button class="boton-pagar-mas" type="submit" name="agregar" value="Agregar"><ion-icon name="add-circle-outline"></ion-icon></button>
              </form>
                                
            <div class="cerrar-popup" onclick="cerrarPopup()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

    <div class="popup" id="popup2">
        <div class="popup-contenido">
            <h2>Categorias:</h2>

            <p></p>
            
            <form action="" method="POST" class="formulario">
                <div class="form-element">
                    <label for="name">Agregar: </label>
                    <input type="text" name="nombre" required>
                    <button class="boton-pagar" type="submit" name="agregar" value="Agregar"><ion-icon name="add-circle-outline"></ion-icon></button>
                </div>
            </form>

            <p></p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Categorias productos</th>
                        <th colspan="1"> </th> 
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bebidas</td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td>Hot dogs</td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td>Frituras</td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td>Promociones</td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td>Bebidas</td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td>Hot dogs</td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td>Frituras</td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                    <tr>
                        <td>Promociones</td>
                        <td><ion-icon name="trash-outline" class="icono-eliminar"></ion-icon></td> 
                    </tr>
                </tbody>
            </table>
            <div class="cerrar-popup" onclick="cerrarPopup2()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>
</body>
</html>