function confirmarCerrarSesion() {
    var respuesta = confirm("¿Realmente desea cerrar sesión?");
    if (respuesta) {
        cerrarSesion();
    }
}

function cerrarSesion() {
    var parametros = {
        "usuario": "x",
        "clave": "x",
        "lleve": "cerrar"
    };
    $.ajax({

        data: parametros,
        url: '../../app/Controlador/iniciar_sesion.php',
        type: 'POST', 
        success: function(json)
        {
            try {
                var data = JSON.parse(json);
                // Acceder a las propiedades específicas del JSON
                var mensaje = data.mensaje
                if(mensaje == 'cerrar')
                {
                    window.location.href = "carta-vendedor.php";
                }                        
            } catch (error) {
                // Maneja el error de análisis JSON
                console.error("Error al analizar el JSON: " + error);
                window.location.href = "login.php";
            }
        }
    });
}
