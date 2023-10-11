// Variables para rastrear los productos seleccionados
const carrito = {};

// Agregar productos al carrito al hacer clic en "Agregar al carrito"
const botonesAgregar = document.querySelectorAll('.agregar');
botonesAgregar.forEach((boton) => {
    boton.addEventListener('click', (e) => {
        const producto = e.target.closest('.producto');
        agregarProducto(producto);
    });
});

function agregarProducto(producto) {
    const id = producto.getAttribute('data-id');
    if (carrito[id]) {
        carrito[id].cantidad++;
    } else {
        carrito[id] = {
            cantidad: 1,
            nombre: producto.querySelector('h2').textContent,
            precio: 10, // Precio del producto
        };
    }
    actualizarCarrito();
}

// Actualizar el carrito en la página
function actualizarCarrito() {
    const carritoContainer = document.getElementById('carrito-container');
    carritoContainer.innerHTML = ''; // Limpia el contenido anterior
    for (const productoId in carrito) {
        const producto = carrito[productoId];
        const item = document.createElement('div');
        item.innerHTML = `
            <button class="resta">-</button>
            ${producto.cantidad}
            <button class="suma">+</button>
            ${producto.nombre}
            $${producto.precio * producto.cantidad}
            <button class="eliminar">X</button>
        `;
        carritoContainer.appendChild(item);
    }
    const subtotal = calcularSubtotal();
    const subtotalElement = document.getElementById('subtotal');
    subtotalElement.textContent = `Subtotal: $${subtotal}`;
}

// Calcula el subtotal
function calcularSubtotal() {
    let total = 0;
    for (const productoId in carrito) {
        const producto = carrito[productoId];
        total += producto.precio * producto.cantidad;
    }
    return total;
}

// Abre el cuadro de diálogo emergente al hacer clic en "Pagar"
const botonPagar = document.getElementById('pagar');
botonPagar.addEventListener('click', () => {
    mostrarPopup();
});

// Muestra el cuadro de diálogo emergente
function mostrarPopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'block';
    actualizarResumen();
}

// Actualiza el resumen en el cuadro de diálogo emergente
function actualizarResumen() {
    const resumenCarrito = document.getElementById('resumen-carrito');
    resumenCarrito.innerHTML = '';
    for (const productoId in carrito) {
        const producto = carrito[productoId];
        const item = document.createElement('div');
        item.textContent = `${producto.cantidad} x ${producto.nombre}`;
        resumenCarrito.appendChild(item);
    }
    const total = calcularSubtotal();
    const totalElement = document.getElementById('total');
    totalElement.textContent = `Total: $${total}`;
}

// Función para ocultar el cuadro de diálogo emergente
function ocultarPopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'none';
}

// Botones de pago
const botonEfectivo = document.getElementById('efectivo');
botonEfectivo.addEventListener('click', () => {
    // Lógica de pago en efectivo
    // Ocultar el cuadro de diálogo emergente después de completar el pago
    ocultarPopup();
});

const botonTarjeta = document.getElementById('tarjeta');
botonTarjeta.addEventListener('click', () => {
    // Lógica de pago con tarjeta
    // Ocultar el cuadro de diálogo emergente después de completar el pago
    ocultarPopup();
});
