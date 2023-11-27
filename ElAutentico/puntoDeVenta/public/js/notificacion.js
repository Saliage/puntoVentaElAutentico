document.addEventListener("DOMContentLoaded", function() {
    const iconoNotificacion = document.getElementById("notificacion-icono");
    const notificacionNumero = document.getElementById("notificacion-numero");
    const notificacionPopup = document.getElementById("notificacion-popup");
    const listaNotificaciones = document.getElementById("lista-notificaciones");

    // Obtener notificaciones desde el servidor (puedes usar AJAX o fetch)

    // Simulación de notificaciones (puedes reemplazar esto con datos reales desde el servidor)
    const notificaciones = [
        { mensaje: "Producto X está cerca de vencer", eliminada: false },
        { mensaje: "Producto Y tiene poca cantidad", eliminada: false },
        // Agrega más notificaciones según tus criterios
    ];

    // Filtrar notificaciones no eliminadas
    const notificacionesActivas = notificaciones.filter(notif => !notif.eliminada);

    // Mostrar número de notificaciones
    notificacionNumero.textContent = notificacionesActivas.length;

    // Mostrar notificaciones en el popup
    notificacionesActivas.forEach(notif => {
        const li = document.createElement("li");
        li.textContent = notif.mensaje;

        // Agregar lógica para eliminar notificación al hacer clic
        li.addEventListener("click", function() {
            notif.eliminada = true;
            listaNotificaciones.removeChild(li);
            notificacionNumero.textContent = notificaciones.filter(notif => !notif.eliminada).length;
        });

        listaNotificaciones.appendChild(li);
    });

    // Mostrar o esconder el popup al hacer clic en el icono
    iconoNotificacion.addEventListener("click", function() {
        notificacionPopup.classList.toggle("visible");
    });
});
