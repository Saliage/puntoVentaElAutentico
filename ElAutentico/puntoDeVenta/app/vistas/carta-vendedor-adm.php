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
    
    <script src="../../public/js/jquery-3.7.1.min.js"></script>
    <script src="../../public/js/logOut.js"></script>
    <script src="../../public/js/carta-vendedor-adm.js"></script>
    <script src="../../public/js/notificacion.js"></script>
    <script src="../../public/js/js-maestro.js"></script>

    <title>Carta Vendedor</title>

    <!-- ====================== ESTILOS CSS ==================== -->
    <link rel="stylesheet" href="../../public/css/ccs/carta-vendedor-2.css">
    <link rel="stylesheet" href="../../public/css/ccs/notificacion.css">
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>

<body onload="verProductos()">
 
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
                    <span class="link-icon-io"><ion-icon name="fast-food-outline"></ion-icon></i></span>
                    <span class="link-text">Carta</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../app/vistas/inventario-vendedor.php" class="nav-link">
                    <span class="link-icon"><ion-icon name="clipboard-outline"></ion-icon></i></span>
                    <span class="link-text">Inventario</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../app/vistas/hist_ventas-vendedor.php" class="nav-link">
                    <span class="link-icon"><ion-icon name="book-outline"></ion-icon></i></span>
                    <span class="link-text">Historial Ventas</span>
                </a>
            </li>

            <?php
                if($_SESSION['rol'] == 1){
                echo'
                    <li class="nav-item">
                        <a href="../../app/vistas/carta-administrador.php" class="nav-link">
                            <span class="link-icon"><ion-icon name="person-outline"></ion-icon></i></span>
                            <span class="link-text">Vista administrador</span>
                        </a>
                    </li>
                ';
                }
            ?>
            <li class="nav-item">
            <a class="nav-link" onclick="confirmarCerrarSesion();">
                    <span class="link-icon"><ion-icon name="log-in-outline"></ion-icon></i></span>
                    <span class="link-text">Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Contenido prinipal que deseas desenfocar -->
    <main class="contenido-a-desenfocar">

        <!-- Barra de busqueda y usuario -->
        <div class="barra-busqueda">
            <div class="entrada-busqueda">
                <input type="text" placeholder="Buscar producto">
                <ion-icon name="search" class="icono-busqueda"></ion-icon>
            </div>

            <div class="notificaciones" onclick="mostrarPopupNotificacion()">
                 <ion-icon name="notifications-circle" class="icono-notificaciones"></ion-icon>
            </div>

            <div class="vendedor">
                <ion-icon name="person" class="icono-vendedor"></ion-icon>
                <span class="nombre-vendedor"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido'] ?></span>
            </div>
        </div>

        <!-- Contenedores principales de la pagina -->
        <div class="main-container">

            <!-- Contenedor de la parte izquierda de la pantalla" -->
            <div class="seccion-izquierda">
    
                <!-- Barra de categorias de la carta -->
                  
                <div class="barra-categorias">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </a>
                
                    <div class="container-categorias">
                        <div class="item-categoria">Todos</div>
                        <div class="item-categoria">Sándwiches</div>
                        <div class="item-categoria">Bebidas</div>
                        <div class="item-categoria">Frituras</div>
                        <div class="item-categoria">Hot Dogs</div>
                        <div class="item-categoria">Otros</div>
                    </div>
                
                   
                </div>
                
                <!-- Contenedor para los productos -->
                
                <div class="todos-los-productos">
                    
                    <!-- Productos-->
                    <div id="mostrarProductos"></div>
 
                </div>
            </div>
            
            <!-- Contenedor de la parte derecha de la pantalla" -->
            <div class="seccion-derecha">
    
                <!-- Sección "Calcular Productos" -->
                <div class="calcular-productos" id="carrito">

                </div>
                <!-- Sección "Subtotal" -->
                <div class="subtotal">
                        <div class="subtotal-carrito"> 
                            <h3>SUBTOTAL</h3>
                            <h3>$<span id="totalPagar">0</span></h3> <!-- resume el total de la suma de todos los productos y sus cantidades -->
                        </div>
                    </div>
                <!-- Sección "Pagar" -->
                    <!-- Agrega el botón de Pagar -->
                    <div class="pagar-carrito">
                        <button class="boton-pagar" onclick="mostrarPopup()">Pagar</button>
                    </div>
            </div>
        </div>
    </main>
    <!-- Contenedor del popup de notificaciones(inicialmente oculto) -->
    <div id="popupNotificacion" class="popup" onclick="cerrarPopupNotificacion()">
        <div class="popup-contenido">
            <button class="cerrar-popup" onclick="cerrarPopupNotificacion()"><ion-icon name="close-outline"></ion-icon></button>
            <div id="mensajeNotificacion"></div> <!-- Agrega esta línea -->
            <h2 id="mensajeNotificacion">No hay notificaciones o alertas</h2>
        </div>
    </div>

    <!-- El contenedor del popup (inicialmente oculto) -->
    <div class="popup" id="popup">
        <div class="popup-contenido">
            <h2>Medio de pago:</h2>
            <button class="boton-pago" onclick="realizarPago('Efectivo')">Efectivo</button>
            <button class="boton-pago" onclick="realizarPago('Tarjeta')">Tarjeta</button>
        </div>
     </div>
    <!-- JavaScript para manejar el evento de clic y agregar/eliminar la clase "seleccionado" al elemento seleccionado. -->
    <script>
    // Obtenemos todos los elementos de categoría
    const itemsCategoria = document.querySelectorAll('.item-categoria'); 
    // Agregamos un controlador de eventos de clic a cada elemento de categoría    
    itemsCategoria.forEach(item => {
        item.addEventListener('click', () => {        
            // Eliminamos la clase 'seleccionado' de todos los elementos
            itemsCategoria.forEach(otherItem => otherItem.classList.remove('seleccionado'));
            // Agregamos la clase 'seleccionado' solo al elemento seleccionado
            item.classList.add('seleccionado');
        });
    });
    </script>
    <script>
        // Función para mostrar el popup
function mostrarPopup() {
  const popup = document.getElementById('popup');
  popup.style.display = 'flex';

              // Reproducir el sonido cuando se muestra el popup
            //const audio = new Audio('../../public/music/sonido_de_dinero.mp3');
            //audio.play();
}

// Función para realizar el pago
function realizarPago(medioPago) {
  alert(`Has elegido pagar con ${medioPago}`);
  // Puedes agregar aquí la lógica para procesar el pago
  const popup = document.getElementById('popup');
  popup.style.display = 'none'; // Cierra el popup
}
    </script>

</body>
</html>