function verProductos(){

    var parametros =
    {
        "opcion":"ver"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_ventas.php',
        type: 'POST',
        
        beforesend: function()
        {
            $('#mostrarProductos').html("Error de comunicación");
        },

        success: function(mensaje)
        {
            $('#mostrarProductos').html(mensaje);
        }
    });
}

function agregarAlCarrito(nombre,precio) {

    const carritoContainer = document.getElementById('carrito');
    const itemDiv = document.createElement('div');
    itemDiv.classList.add('item');
    itemDiv.innerHTML = `<span>${nombre}</span><span>$${precio}</span>`;
    carritoContainer.appendChild(itemDiv);    

}