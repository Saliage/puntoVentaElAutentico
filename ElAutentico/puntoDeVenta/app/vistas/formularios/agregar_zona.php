<?php 
    require("../../modelo/almacen.php");
    $almacen = new Almacen();
    $almacenes = $almacen->listarAlmacenes();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../public/imagenes/LogoFoodTruck.jpg">

    <title>Zonas</title>

    <!-- ====================== ESTILOS CSS ==================== -->
    <link rel="stylesheet" href="../../../public/css/ccs/carta-administrador.css">
    <!-- ====================== JS ==================== -->
    <script src="../../public/js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>

<body>
    <!-- -------- BARRA DE NAVEGACION ------- -->
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="logo">
                <a href="../../app/vistas/carta-vendedor.html" class="nav-link-menu">
                    <span class="link-icon"><ion-icon name="menu-outline"></ion-icon></i></span>
                    <span class="link-text">Menu</span>
                </a>
            </li>

            <!-- -------- ITEMS DE BARRA DE NAVEGACION ------- -->
            <li class="nav-item">
                <a href="../../app/vistas/carta-vendedor.html" class="nav-link">
                    <span class="link-icon"><ion-icon name="fast-food-outline"></ion-icon></i></span>
                    <span class="link-text">Carta</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../app/vistas/inventario-vendedor.html" class="nav-link">
                    <span class="link-icon"><ion-icon name="clipboard-outline"></ion-icon></i></span>
                    <span class="link-text">Inventario</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../app/vistas/hist_ventas-vendedor.html" class="nav-link">
                    <span class="link-icon-io"><ion-icon name="book-outline"></ion-icon></i></span>
                    <span class="link-text">Historial Ventas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../app/vistas/login-v2.html" class="nav-link">
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
                <input type="text" placeholder="Buscar">
                <ion-icon name="search" class="icono-busqueda"></ion-icon>
            </div>
            <div class="vendedor">
                <ion-icon name="person" class="icono-vendedor"></ion-icon>
                <span class="nombre-vendedor">Maria Helena Saldaña</span>
            </div>
        </div>

     <!-- Tabla para mostrar los insumos con Bootstrap -->
  
        <div class="tabla-inventario">

            <div class="container">
                <h1 class="text-center">ZONAS</h1>
                <hr>
                <div class="row text-center">
                    <div class="col">

                    
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" required>

                        <label for="almacen_id">Almacen ID:</label>
                        <select name="almacen_id" id="almacen_id" required>
                            <?php 
                                if ($almacenes->num_rows > 0) {
                                    // Recorrer almacenes presentes
                                    while ($dato = $almacenes->fetch_assoc()) {
                                        echo '<option value="' . $dato['id_almacen'] . '">' . $dato['nombre'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="0">NULL</option>';
                                }
                        ?>
                        </select>
                        <input type="button" class="btn btn-primary" value="Agregar Zona" onclick="mostrar(1);"> <br>
                   
                        
                        
                        <label for="buscador">Ingresa nombre de la zona: </label>
                        <input type="text" name="buscador" id="buscador" class="form-control" onkeypress="mi_busqueda();">
                        
                        <input type="button" class="btn btn-primary" value="Ver Zonas" onclick="mostrar(2);">
        
                    </div>
                
                </div>
        
                <hr>
                <h2 class="text-center">DETALLES</h2>
                <div class="row justify-content-md-center">		
                    <div class="col-md-8">
                        <div id="mostrar_mensaje"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<!--   CODIGO AJAX PARA CONTROLAR EVENTOS -->
    <script>
        function mi_busqueda()
        { 
            buscar = document.getElementById('buscador').value;
            nombre = document.getElementById('nombre').value;
            almacenId = document.getElementById('almacen_id').value;
        var parametros = 
        {
            "mi_busqueda" : buscar,
            "nombre" : nombre,
            "almacen_id" : almacenId,
            "opcion" : "3"
        };

        $.ajax({
            data: parametros,
            url: '../gestion/gestion_zona.php',
            type: 'POST',
            
            beforesend: function()
            {
            $('#mostrar_mensaje').html("Error de comunicación");
            },

            success: function(mensaje)
            {
            $('#mostrar_mensaje').html(mensaje);
            }
        });
        }

        function mostrar(opcion)
        { 
            buscar = document.getElementById('buscador').value;
            nombre = document.getElementById('nombre').value;
            almacenId = document.getElementById('almacen_id').value;
            
        var parametros = 
        {
            "mi_busqueda" : buscar,
            "nombre" : nombre,
            "almacen_id" : almacenId,
            "opcion" : opcion
        };

        $.ajax({
            data: parametros,
            url: '../gestion/gestion_zona.php',
            type: 'POST',
            
            beforesend: function()
            {
            $('#mostrar_mensaje').html("Error de comunicación");
            },

            success: function(mensaje)
            {
            $('#mostrar_mensaje').html(mensaje);
            }
        });
        }
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


