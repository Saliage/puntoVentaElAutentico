// JavaScript para manejar el evento de clic y agregar/eliminar la clase "seleccionado" al elemento seleccionado. -->
    
    // Obtenemos todos los elementos de categoría
    const itemsCategoria = document.querySelectorAll('.item-categoria'); 
    
    // Agregamos un controlador de eventos de clic a cada elemento de categoría    
    itemsCategoria.forEach(item => {
        item.addEventListener('click', () => {        
            // Eliminamos la clase 'seleccionado' de todos los elementos
            itemsCategoria.forEach(otherItem => otherItem.classList.remove('seleccionado'));
            // Agregamos la clase 'seleccionado' solo al elemento seleccionado
            item.classList.add('seleccionado');
        });
    });

    // Función para mostrar el popup

    function cerrarPopup() {
        const popup = document.getElementById('popup');
        popup.style.display = 'none';
    }

    function mostrarPopup() {
        const popup = document.getElementById('popup');
        popup.style.display = 'flex';
    }

    function mostrarPopup2() {
        const popup = document.getElementById('popup2');
        popup.style.display = 'flex';
    }

    function cerrarPopup2() {
        const popup = document.getElementById('popup2');
        popup.style.display = 'none';
    }

    function mostrarPopup3() {
        const popup = document.getElementById('popup3');
        popup.style.display = 'flex';
    }

    function cerrarPopup3() {
        const popup = document.getElementById('popup3');
        popup.style.display = 'none';
    }

    function mostrarPopup4() {
        const popup = document.getElementById('popup4');
        popup.style.display = 'flex';
    }

    function cerrarPopup4() {
        const popup = document.getElementById('popup4');
        popup.style.display = 'none';
    }

    function mostrarPopup5() {
        const popup = document.getElementById('popup5');
        popup.style.display = 'flex';
    }

    function cerrarPopup5() {
        const popup = document.getElementById('popup5');
        popup.style.display = 'none';
    }

    function mostrarPopup7() {
        const popup = document.getElementById('popup7');
        popup.style.display = 'flex';
    }

    function cerrarPopup7() {
        const popup = document.getElementById('popup7');
        popup.style.display = 'none';
    }

    function mostrarPopup8() {
        const popup = document.getElementById('popup8');
        popup.style.display = 'flex';
    }

    function cerrarPopup8() {
        const popup = document.getElementById('popup8');
        popup.style.display = 'none';
        listarInsumosFormat();
        
    }

    function mostrarPopup9() {
        const popup = document.getElementById('popup9');
        popup.style.display = 'flex';
    }

    function cerrarPopup9() {
        const popup = document.getElementById('popup9');
        popup.style.display = 'none';
    }
