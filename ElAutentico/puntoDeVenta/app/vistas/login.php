<?php 
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
        
        
        <link rel="stylesheet" href="../../public/css/ccs/login-v2.css">
        <link rel="icon" href="../../public/imagenes/LogoFoodTruck.jpg">
        

        

    <title>Iniciar sesion</title>
</head>

<body class="animacion-fondo">
    <div class="container">
        <div class="form-login" id="form-login">

            <!-- Logo y texto debajo del logo -->
            <div class="text-center mb-4 d-flex-custom">
                <img class="mb-3 mt-2 user-select-none" src="../../public/imagenes/LogoFoodTruck.jpg" alt="Logo-LogoFoodTruck"
                    width="auto" height="72" draggable="false">
                <h1 class="mb-3">Bienvenido</h1>
                <p class="d-block-custom">Ingrese su nombre de usuario y contraseña</p>
            </div>

            <!-- Usuario -->
            <div class="form-label-group">
                <input type="text" id="usuario" class="form-control" placeholder="Usuario" required="" onkeydown="checkEnter(event)">
                <label for="usuario">Nombre de usuario</label>
            </div>

            <!-- Contraseña -->
            <div class="form-label-group">
                <input type="password" id="clave" class="form-control no-select" placeholder="Contraseña" required="" onkeydown="checkEnter(event)">
                <label for="clave">Contraseña</label>
            </div>

            <!-- Mensaje -->
            <div class="mb-4 mt-4" id="mostrarError">
                
            </div>

            
            <!-- Boton -->
            <button class="btn btn-primary btn-lg w-100 py-2" type="submit" onclick="iniciarSesion()">Iniciar sesion</button>

            
        </div>
    </div>

    <script src="../../public/js/jquery-3.7.1.min.js"></script>
    <script>

        function iniciarSesion() {

            var usuario = document.getElementById("usuario").value;
            var clave = document.getElementById("clave").value;
            
            var parametros = {
                "usuario": usuario,
                "clave": clave,
                "llave": "nada"
            };
            
            $.ajax({
                data: parametros,
                url: '../Controlador/iniciar_sesion.php',
                type: 'POST',
                
                beforeSend: function()
                {
                    $('#mostrarError').html("Error de comunicación");
                },

                success: function(mensaje)
                {
                    try {
                        
                        if(mensaje == 'OK')
                        {
                            window.location.href = "carta-vendedor-adm.php";
                        }
                        else
                        {
                            $('#mostrarError').html(mensaje);
                        }
                        
                    } catch (error) {
                        // Maneja el error de análisis JSON
                        console.error("Error al analizar el JSON: " + error);
                        $('#mostrarError').html("Error al procesar la respuesta del servidor");
                        alert(error);
                    }
                }
            });
        }

        function checkEnter(event) {
        if (event.keyCode === 13) {
            // 13 es el código de la tecla Enter
            iniciarSesion();
        }
    }


    </script>
</body>

</html>