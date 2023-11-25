function inicializar(){

    verProductos();
    verTiposProd();
}

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

function verTiposProd(){
    var parametros =
    {
        "opcion":"verCat"
    }
    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_ventas.php',
        type: 'POST',
        
        beforesend: function()
        {
            $('#verPorCat').html("Error de comunicación");
        },

        success: function(mensaje)
        {
            $('#verPorCat').html(mensaje);
        }
    });
}

function verProdByCat(id){

    var parametros =
    {
        "idTipo" : id,
        "opcion":"verXTipo"
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

function buscarProducto() {
    var busqueda = document.getElementById('busqueda').value;
    var parametros = 
    {
        "busqueda" : busqueda,
        "opcion" : "buscar"
    };
    
    $.ajax({
        data : parametros,
        url: '../Controlador/gestion_ventas.php',
        type: 'POST',
        beforeSend: function() {
            //$('#mostrarProductos').html("No hay Productos en la carta para mostrar");
        },
        success: function(mensaje) {
            $('#mostrarProductos').html(mensaje);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown); //ver errores
        }
    });
}

// Variable para almacenar el estado del carrito
let carrito = [];

function agregarAlCarrito(id, nombre, precio) {
    // Verifica si el artículo ya está en el carrito
    const articuloExistente = carrito.find(articulo => articulo.id === id);

    if (articuloExistente) {
        // Si el artículo ya está en el carrito, sumar 1
        articuloExistente.cantidad += 1;
    } else {
        // Si el artículo no está en el carrito, agrégalo
        carrito.push({
            id: id,
            nombre: nombre,
            precio: precio,
            cantidad: 1
        });
    }

    // Actualiza la interfaz del carrito
    actualizarInterfazCarrito();
}

function aumentarCantidad(id) {
    const articulo = carrito.find(articulo => articulo.id === id);
    if (articulo) {
        articulo.cantidad += 1;
        actualizarInterfazCarrito();
    }
}

function disminuirCantidad(id) {
    const articulo = carrito.find(articulo => articulo.id === id);
    if (articulo && articulo.cantidad > 1) {
        articulo.cantidad -= 1;
        actualizarInterfazCarrito();
    } else {
        eliminarDelCarrito(id);
    }
}

function eliminarDelCarrito(id) {
    carrito = carrito.filter(articulo => articulo.id !== id);
    actualizarInterfazCarrito();
}


function calcularPrecioTotal() {
    return carrito.reduce((total, articulo) => total + (articulo.precio * articulo.cantidad), 0);
}

function actualizarInterfazCarrito() {
    const contenedorCarrito = document.getElementById('carrito');

    // Limpia el contenido del contenedor
    contenedorCarrito.innerHTML = '';

    // Itera sobre los artículos en el carrito y crea elementos HTML para cada uno
    carrito.forEach(articulo => {
        const elementoArticulo = document.createElement('div');
        elementoArticulo.classList.add('producto-carrito');

        // Añade el nombre, cantidad, precio, iconos, etc., a elementoArticulo
        elementoArticulo.innerHTML = `
            <ion-icon name="remove-circle-outline" onclick="disminuirCantidad(${articulo.id})"></ion-icon>
            <div class="numero">${articulo.cantidad}</div>
            <ion-icon name="add-circle-outline" onclick="aumentarCantidad(${articulo.id})"></ion-icon>
            <h3>${articulo.id}</h3>
            <h3>$<span id="totalPagar">${articulo.precio * articulo.cantidad}</span></h3>
            <ion-icon name="close-outline" onclick="eliminarDelCarrito(${articulo.id})"></ion-icon>
        `;

        // Añade elementoArticulo al contenedorCarrito
        contenedorCarrito.appendChild(elementoArticulo);
    });

    // Calcula el precio total y actualiza la interfaz con el total
    const precioTotal = calcularPrecioTotal();
    actualizarInterfazPrecioTotal(precioTotal);
}

function actualizarInterfazPrecioTotal(precioTotal) {
    // Obtén el elemento del subtotal en el DOM
    const subtotalElemento = document.querySelector('.subtotal h3:last-child');

    // Actualiza el contenido del elemento con el precio total
    subtotalElemento.textContent = `$${precioTotal}`;
} 

