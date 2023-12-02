// Variable para verificar si hay notificaciones
let hayNotificaciones = false;

// Función para mostrar el popup de notificaciones
function mostrarPopupNotificacion(mensaje) {
    const popupNotificacion = document.getElementById('popupNotificacion');
    const mensajeNotificacion = document.getElementById('mensajeNotificacion');

    // Mostrar el mensaje en el popup
    mensajeNotificacion.innerText = mensaje;

    // Cambiar el color y hacer parpadear el icono de notificaciones si hay notificaciones
    const iconoNotificaciones = document.querySelector('.icono-notificaciones');
    if (hayNotificaciones) {
        iconoNotificaciones.style.color = 'red';
        hacerParpadear(iconoNotificaciones);
    } else {
        iconoNotificaciones.style.color = ''; // Restablecer el color normal
    }

    // Mostrar el popup
    popupNotificacion.style.display = 'flex';

    // Cerrar el popup después de 10 segundos
    setTimeout(() => {
        cerrarPopupNotificacion();
    }, 10000);
}

// Función para hacer parpadear un elemento
function hacerParpadear(elemento) {
    let intervalo;
    let visible = true;

    intervalo = setInterval(() => {
        if (visible) {
            elemento.style.visibility = 'hidden';
        } else {
            elemento.style.visibility = 'visible';
        }
        visible = !visible;
    }, 500); // Cambia la visibilidad cada 500 milisegundos

    // Detener el parpadeo después de 3 segundos
    setTimeout(() => {
        clearInterval(intervalo);
        elemento.style.visibility = 'visible'; // Asegurarse de que el elemento sea visible al final
    }, 3000);
}

// Función para cerrar el popup de notificaciones
function cerrarPopupNotificacion() {
    const popupNotificacion = document.getElementById('popupNotificacion');
    popupNotificacion.style.display = 'none';
}

// Función para verificar las notificaciones y actualizar el estado
function verificarNotificaciones() {
    // Realizar solicitud AJAX al servidor para obtener datos
    $.ajax({
        url: 'ruta/al/script/que/obtiene/notificaciones.php', // Reemplaza con la ruta correcta a tu script PHP
        method: 'GET',
        success: function (response) {
            try {
                const data = JSON.parse(response);
                const cantidad = data.cantidad; // Obtén estos valores desde la respuesta JSON
                const diasVencimiento = data.diasVencimiento;

                // Verificar las condiciones para mostrar el mensaje de notificación
                if (cantidad <= 5) {
                    hayNotificaciones = true;
                    mostrarPopupNotificacion(`Quedan ${cantidad} unidades de "${data.nombreInsumo}"`);
                } else if (diasVencimiento <= 7) {
                    hayNotificaciones = true;
                    mostrarPopupNotificacion(`El insumo "${data.nombreInsumo}" vence en ${diasVencimiento} días`);
                } else {
                    hayNotificaciones = false;
                    mostrarPopupNotificacion('No hay notificaciones o alertas');
                }
            } catch (error) {
                console.error('Error al analizar la respuesta JSON:', error);
            }
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

// Llamada inicial para verificar las notificaciones al cargar la página
verificarNotificaciones();
