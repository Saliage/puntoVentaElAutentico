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

    <title>Inventario Vendedor</title>

    <!-- ====================== ESTILOS CSS ==================== -->
    <link rel="stylesheet" href="../../public/css/ccs/carta-administrador.css">
    <!-- ====================== JS ==================== -->
    <script src="../../public/js/jquery-3.7.1.min.js"></script>
    <script src="../../public/js/logOut.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>

<body>
    <!-- -------- BARRA DE NAVEGACION ------- -->
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="logo">
                <a href="../../app/vistas/carta-vendedor.php" class="nav-link-menu">
                    <span class="link-icon"><ion-icon name="menu-outline"></ion-icon></i></span>
                    <span class="link-text">Menu</span>
                </a>
            </li>

            <!-- -------- ITEMS DE BARRA DE NAVEGACION ------- -->
            <li class="nav-item">
                <a href="../../app/vistas/carta-vendedor.php" class="nav-link">
                    <span class="link-icon"><ion-icon name="fast-food-outline"></ion-icon></i></span>
                    <span class="link-text">Carta</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../app/vistas/inventario-vendedor.php" class="nav-link">
                    <span class="link-icon-io"><ion-icon name="clipboard-outline"></ion-icon></i></span>
                    <span class="link-text">Inventario</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../app/vistas/hist_ventas-vendedor.php" class="nav-link">
                    <span class="link-icon"><ion-icon name="book-outline"></ion-icon></i></span>
                    <span class="link-text">Historial Ventas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../app/vistas/carta-administrador.php" class="nav-link">
                    <span class="link-icon"><ion-icon name="person-outline"></ion-icon></i></span>
                    <span class="link-text">Vista administrador</span>
                </a>
            </li>
            <li class="nav-itemi">
                <a class="nav-linki" onclick="confirmarCerrarSesion();">
                    <span class="linki-icon"><ion-icon name="log-in-outline"></ion-icon></i></span>
                    <span class="linki-text">Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Contenido principal que deseas desenfocar -->
    <main class="contenido-a-desenfocar">

        <!-- Barra de busqueda y usuario -->
        <div class="barra-busqueda">
            <div class="entrada-busqueda">
                <input type="text" placeholder="Buscar insumo">
                <ion-icon name="search" class="icono-busqueda"></ion-icon>
            </div>
            <div class="vendedor">
                <ion-icon name="person" class="icono-vendedor"></ion-icon>
                <span class="nombre-vendedor"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido'] ?></span>
            </div>
        </div>

        <!-- Tabla para mostrar los insumos con Bootstrap -->
        <div>
        <div class="tabla-inventario">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id de Insumo</th>
                        <th>Imagen de Insumo</th>
                        <th>Nombre de Insumo</th>
                        <th>Cantidad Disponible</th>
                        <th>Fecha de Vencimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>
                            <img src="../../public/imagenes/coca-cola-zero.jpg" alt="Insumo 1">
                        </td>
                        <td>Cola Cola Zero 591ml</td>
                        <td>49</td>
                        <td>2024-05-31</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>
                            <img src="../../public/imagenes/fanta-zero.jpeg" alt="Insumo 2">
                        </td>
                        <td>Fanta Zero 591ml</td>
                        <td>30</td>
                        <td>2024-06-15</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>
                            <img src="../../public/imagenes/coca-cola-zero.jpg" alt="Insumo 1">
                        </td>
                        <td>Cola Cola Zero 591ml</td>
                        <td>49</td>
                        <td>2024-05-31</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>
                            <img src="../../public/imagenes/fanta-zero.jpeg" alt="Insumo 2">
                        </td>
                        <td>Fanta Zero 591ml</td>
                        <td>30</td>
                        <td>2024-06-15</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>
                            <img src="../../public/imagenes/coca-cola-zero.jpg" alt="Insumo 1">
                        </td>
                        <td>Cola Cola Zero 591ml</td>
                        <td>49</td>
                        <td>2024-05-31</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>
                            <img src="../../public/imagenes/fanta-zero.jpeg" alt="Insumo 2">
                        </td>
                        <td>Fanta Zero 591ml</td>
                        <td>30</td>
                        <td>2024-06-15</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>
                            <img src="../../public/imagenes/coca-cola-zero.jpg" alt="Insumo 1">
                        </td>
                        <td>Cola Cola Zero 591ml</td>
                        <td>49</td>
                        <td>2024-05-31</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>
                            <img src="../../public/imagenes/fanta-zero.jpeg" alt="Insumo 2">
                        </td>
                        <td>Fanta Zero 591ml</td>
                        <td>30</td>
                        <td>2024-06-15</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>
                            <img src="../../public/imagenes/coca-cola-zero.jpg" alt="Insumo 1">
                        </td>
                        <td>Cola Cola Zero 591ml</td>
                        <td>49</td>
                        <td>2024-05-31</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>
                            <img src="../../public/imagenes/fanta-zero.jpeg" alt="Insumo 2">
                        </td>
                        <td>Fanta Zero 591ml</td>
                        <td>30</td>
                        <td>2024-06-15</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>
                            <img src="../../public/imagenes/coca-cola-zero.jpg" alt="Insumo 1">
                        </td>
                        <td>Cola Cola Zero 591ml</td>
                        <td>49</td>
                        <td>2024-05-31</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>
                            <img src="../../public/imagenes/fanta-zero.jpeg" alt="Insumo 2">
                        </td>
                        <td>Fanta Zero 591ml</td>
                        <td>30</td>
                        <td>2024-06-15</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>
                            <img src="../../public/imagenes/coca-cola-zero.jpg" alt="Insumo 1">
                        </td>
                        <td>Cola Cola Zero 591ml</td>
                        <td>49</td>
                        <td>2024-05-31</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>
                            <img src="../../public/imagenes/fanta-zero.jpeg" alt="Insumo 2">
                        </td>
                        <td>Fanta Zero 591ml</td>
                        <td>30</td>
                        <td>2024-06-15</td>
                    </tr>
                    <tr>
                        <td>001</td>
                        <td>
                            <img src="../../public/imagenes/coca-cola-zero.jpg" alt="Insumo 1">
                        </td>
                        <td>Cola Cola Zero 591ml</td>
                        <td>49</td>
                        <td>2024-05-31</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>
                            <img src="../../public/imagenes/fanta-zero.jpeg" alt="Insumo 2">
                        </td>
                        <td>Fanta Zero 591ml</td>
                        <td>30</td>
                        <td>2024-06-15</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>