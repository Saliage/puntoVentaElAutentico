

function verVentas(vendedor){    

    var parametros =
    {
        "vendedor" :vendedor,
        "opcion":"verVentas"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_ventas.php',
        type: 'POST',
        
        beforesend: function()
        {
        },

        success: function(mensaje)
        {
            $('#mostrarVentas').html(mensaje);
        }
    });


}