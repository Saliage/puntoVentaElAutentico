<?php 
    session_start();
    ob_start();

    if($_SESSION['sesion'] <>1)
    {
      header('Location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="es">

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
    <script src="../../public/js/inventario-administrador.js"></script>
    <script src="../../public/js/inventario.js"></script>
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
                    <span class="link-icon-io"><ion-icon name="clipboard-outline"></ion-icon></i></span>
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
                <input type="search" placeholder="Buscar insumo">
                <ion-icon name="search" class="icono-busqueda"></ion-icon>
            </div>
            <div class="vendedor">
                <ion-icon name="person" class="icono-vendedor"></ion-icon>
                <span class="nombre-vendedor"><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido'] ?></span>
            </div>
        </div>

        <div class="tabla-inventario">

            <table class="table">
                <thead>
                    <button class="boton-pagar2" onclick="mostrarPopup3()">Zonas</button>
                    <button class="boton-pagar2" onclick="mostrarPopup4()">Almacenes</button>
                    <button class="boton-pagar2" onclick="mostrarPopup5()">Proovedores</button>
                    <button class="boton-pagar2" onclick="mostrarPopup7()">Tipos Movimientos</button>
                    <button class="boton-pagar" onclick="mostrarPopup8()">Entrada insumo</button>
                    <button class="boton-pagar3" onclick="mostrarPopup9()">Salida insumo</button>
                </thead> <br><br>   
                <tbody>
                    <div id="mostrarInventario"></div>
                </tbody>
            </table>
        </div>
    </main>

<!----------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------                 GESTION ZONAS                 -------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="popup" id="popup3">
        <div class="popup-contenido">
            <h2>Zonas</h2>
            
            <div class="formulario" id="formZonas">
                <div>
                    <label for="nombreZonaTxt">Nombre:</label>
                    <input type="text" name="nombre" id="nombreZonaTxt" pattern=".{5,}"   required>
                </div>
                <div>
                    <label for="almacen_id">Almacen:</label>
                    <div id="slectAlmacenes" style="display: inline;"></div> <!-- genera un select vía AJAX desde el servidor con el contenido de la BD -->                    
                </div>
                <button onclick="agregarZona();"><ion-icon name="add-circle-outline" ></ion-icon></button>
            </div>
            <hr>
                <tbody>
                    <div id="mostrarZonas"></div>
                </tbody>
            </table>
            <div class="cerrar-popup" onclick="cerrarPopup3()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

<!----------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------                GESTION ALMACENES              -------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="popup" id="popup4">
        <div class="popup-contenido">
            <h2>Almacenes</h2>
            
            <div class="formulario" id="formAlmacenes">
                <div>
                    <label for="nombreAlmacenTxt">Nombre:</label>
                    <input type="text" name="nombre" id="nombreAlmacenTxt" pattern=".{5,}"  required>
                </div>
                <div>
                    <label for="sala_chk">Pertenece a sala de ventas:</label>
                    <input type="checkbox" id="sala_chk">
                </div>
                <button onclick="agregarAlmacen();"><ion-icon name="add-circle-outline" ></ion-icon></button>
            </div>
            <hr>
                <tbody>
                    <div id="verAlmacenes"></div>
                </tbody>
            </table>
            <div class="cerrar-popup" onclick="cerrarPopup4()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>
<!----------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------               GESTION PROVEEDORES             -------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="popup" id="popup5">
        <div class="popup-contenido">
            <h2>Proovedores</h2>

                <form id="formAgregarProveedor" onsubmit="return agregarProveedor(event)" method="post">
                
                    <div class="form-element">
                        <label for="nombre">Nombre:</label>
                        <h3>* </h3><input type="text" name="nombre" id="nombre" placeholder="Nombre"  pattern="[A-Za-z\d]{3,}$" title="Nombre de al menos 3 caracteres">
                    </div>
                    <div id="validaRUT"></div>                     
                    <div class="form-element">
                        <label for="rut">Rut:</label>
                        <h3>* </h3><input type="text" name="rut" id="rut" oninput="validarRutTxt()" placeholder="rut" minlength="9" maxlength="11"  pattern="^[0-9]+-[0-9kK]$|^[0-9]+[kK]-[0-9]$"  
                        title="Ingrese un rut valido sin puntos y con guion en el formato: 12345678-9 ó 12345678-K" required>
                    </div>                                      
                    <div class="form-element"><label for="fono">Fono:</label>
                        <input type="text" name="fono" id="fono" pattern="[0-9\+]{8,12}" placeholder="Fono" title="Ingrese número telefónico válido" >
                    </div>    
                    <div class="form-element">
                        <label for="emailProveedor">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Correo electrónico" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.\.[a-zA-Z]{2,}$" 
                        title="Ingresa un correo electrónico válido en formato user@dominio.xx">
                    </div>
                    <div class="form-element">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" placeholder="Dirección" minlength="8">
                    </div>                        
                    <div id="mostrarRoles" class="form-element"> <!-- listar roles en combobox -->
                       
                    </div>
                    <input class="boton-pago" type="submit" name="agregar" value="Agregar">
                </form>

                <div id="verProveedores"></div>
            </table>
            <div class="cerrar-popup" onclick="cerrarPopup5()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

<!----------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------                 ENTRADA INSUMO            -------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="popup" id="popup8">
        <div class="popup-contenido">
            <h2>Registrar entrada insumo</h2>
            <P></P>
            <form id="formEntradaInsumo" onsubmit="return entradaInsumo(event)" method="GET">
                
                    <div class="form-element">
                        <label for="nombre">Insumo:</label>
                        <div id="listarInsumos"></div>
                    </div>                  
                    <div class="form-element">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad" min="1" title="Ingrese la cantidad de producto" required>
                    </div>                                      
                    <div class="form-element"><label for="costo">Costo:</label>
                        <input type="number" name="costo" id="costo" placeholder="costo" min="1" title="Ingrese el costo unitario" >
                    </div>    
                    <div class="form-element">                        
                        <label for="fecha" id="fec_ven" style="display: none;">Fecha de vencimiento:</label>
                        <div id="pedirFec_ven"></div>
                    </div>
                    <div class="form-element">
                        <label for="listarAlmacenes">Almacen:</label>
                        <div id="listarAlmacenes"></div>
                    </div>                        
                    <div class="form-element">
                        <label for="listarZonas">Zona: </label>
                        <div id="listarZonas"></div>
                    </div>
                    <input class="boton-pago" type="submit" name="agregar" value="Registrar">
                </form>
            <div class="cerrar-popup" onclick="cerrarPopup8(); listarInsumosFormat()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

    <script>
    // JavaScript para deseleccionar la opción de marcador de posición si se selecciona otra opción
    document.getElementById("insumo").addEventListener("change", function() {
        var placeholderOption = this.querySelector('option[value=""]');
        if (this.value !== "") {
            placeholderOption.removeAttribute("selected");
            placeholderOption.setAttribute("disabled", "disabled");
        } else {
            placeholderOption.setAttribute("selected", "selected");
            placeholderOption.removeAttribute("disabled");
        }
    });
</script>

<!----------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------                  SALIDA INSUMO             -------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="popup" id="popup9">
        <div class="popup-contenido">
            <h2>Registrar salida insumo</h2>
            <P></P>
            <form action="" method="POST" class="formulario">
                <div class="form-element">
                    <label for="user">Cantidad</label>
                    <input type="number" min="1" name="stock" placeholder="Cantidad" required>
                </div>
                <button class="boton-pagar-mas" type="submit" name="agregar" value="Agregar"><ion-icon name="remove-circle-outline"></ion-icon></button>
            </form>
            <div class="cerrar-popup" onclick="cerrarPopup9()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

<!----------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------              GESTION TIPO MOVIMIENTO          -------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="popup" id="popup7">
        <div class="popup-contenido">
            <h2>Tipo de Movimientos</h2>
            
            <div class="formulario" id="formMov">
                <div>
                    <label for="tipo_movimiento">Nuevo tipo de movimiento:</label>
                    <input type="text" name="nombre" id="tipo_movimientoTXT" pattern=".{5,}"  required>
                </div>
                <button class="boton-pago" type="submit" name="agregar" onclick="agregarMovimiento()" value="Agregar">Agregar</button>
            </div>
            <hr>
                <tbody>
                    <div id="verTipoMovimiento"></div>
                </tbody>
            </table>
            <div class="cerrar-popup" onclick="cerrarPopup7()"><ion-icon name="close-circle"></ion-icon></div>
        </div>
    </div>

</body>
</html>