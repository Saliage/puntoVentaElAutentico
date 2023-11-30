//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------                 POPUPS                   ----------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->
function mostrarPopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'flex';
}

function cerrarPopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'none'; 

}

    function inicializar(){
        listarProductos();
        mostrarTiposP();
        listarTiposP();
    }

//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------           GESION PRODUCTOS           --------------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->
function buscarProducto() {
    var busqueda = document.getElementById('busqueda').value;
    var parametros = 
    {
        "busqueda" : busqueda,
        "opcion" : "buscar"
    };
    
    $.ajax({
        data : parametros,
        url: '../Controlador/gestion_productos.php',
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

function buscarProductoTipo(categoria) {
    var parametros = 
    {
        "categoria" : categoria,
        "opcion" : "mostrar"
    };
    
    $.ajax({
        data : parametros,
        url: '../Controlador/gestion_productos.php',
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

function listarProductos() {

    var parametros = 
    {
        "opcion" : "mostrar"
    };
    
    $.ajax({
        data : parametros,
        url: '../Controlador/gestion_productos.php',
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

function editarProductos(id){

    var nombre_productoSpan = document.getElementById('nombre_productoSpan'+id);
    var codigo_productoSpan = document.getElementById('codigo_productoSpan'+id);
    var imagenIMG = document.getElementById('imagenIMG'+id);
    var costo_unitarioSpan = document.getElementById('costo_unitarioSpan'+id);
    var precio_ventaSpan = document.getElementById('precio_ventaSpan'+id);
    var descripcionSpan = document.getElementById('descripcionSpan'+id);
    var btnProductosEdit = document.getElementById('btnproductoEdit'+id);
    

    var nombre_productoTxt = document.getElementById('nombre_productoTxt'+id);
    var codigo_productoTxt = document.getElementById('codigo_productoTxt'+id);
    var imagenInput = document.getElementById('imagenINP'+id);
    var costo_unitarioTxt = document.getElementById('costo_unitarioTxt'+id);
    var precio_ventaTxt = document.getElementById('precio_ventaTxt'+id);
    var descripcionTxt = document.getElementById('descripcionTxt'+id);
    var guardarProductoEdit = document.getElementById('guardarProductoEdit'+id);

    // Mostrar el campo de texto y ocultar el span

    nombre_productoSpan.style.display = 'none';
    codigo_productoSpan.style.display = 'none';
    imagenIMG.style.display = 'none';
    costo_unitarioSpan.style.display = 'none';
    precio_ventaSpan.style.display = 'none';
    descripcionSpan.style.display = 'none';
    btnProductosEdit.style.display = 'none';

    nombre_productoTxt.style.display = 'inline';
    codigo_productoTxt.style.display = 'inline';
    imagenInput.style.display = 'inline';
    costo_unitarioTxt.style.display = 'inline';
    precio_ventaTxt.style.display = 'inline';
    descripcionTxt.style.display = 'inline';
    guardarProductoEdit.style.display = 'inline';
}

function guardarProductosEdit(id){

    var nombre_productoSpan = document.getElementById('nombre_productoSpan'+id);
    var codigo_productoSpan = document.getElementById('codigo_productoSpan'+id);
    var imagenIMG = document.getElementById('imagenIMG'+id);
    var costo_unitarioSpan = document.getElementById('costo_unitarioSpan'+id);
    var precio_ventaSpan = document.getElementById('precio_ventaSpan'+id);
    var descripcionSpan = document.getElementById('descripcionSpan'+id);
    var btnProductosEdit = document.getElementById('btnproductoEdit'+id);
    

    var nombre_productoTxt = document.getElementById('nombre_productoTxt'+id);
    var codigo_productoTxt = document.getElementById('codigo_productoTxt'+id);
    var imagenInput = document.getElementById('imagenINP'+id);
    var costo_unitarioTxt = document.getElementById('costo_unitarioTxt'+id);
    var precio_ventaTxt = document.getElementById('precio_ventaTxt'+id);
    var descripcionTxt = document.getElementById('descripcionTxt'+id);
    var disponibleCHK = document.getElementById('disponibleCHK'+id);
    var guardarProductoEdit = document.getElementById('guardarProductoEdit'+id);

      //volver inputs a su estado anterior

    nombre_productoSpan.style.display = 'inline';
    codigo_productoSpan.style.display = 'inline';
    imagenIMG.style.display = 'inline';
    costo_unitarioSpan.style.display = 'inline';
    precio_ventaSpan.style.display = 'inline';
    descripcionSpan.style.display = 'inline';
    btnProductosEdit.style.display = 'inline';

    nombre_productoTxt.style.display = 'none';
    codigo_productoTxt.style.display = 'none';
    imagenInput.style.display = 'none';
    costo_unitarioTxt.style.display = 'none';
    precio_ventaTxt.style.display = 'none';
    descripcionTxt.style.display = 'none';
    guardarProductoEdit.style.display = 'none';
    
    var parametros = new FormData();
    parametros.append('id', id);
    parametros.append('nombre', nombre_productoTxt.value);
    parametros.append('codigo', codigo_productoTxt.value);
    parametros.append('rutaImagen', imagenIMG.src);
    parametros.append('imagen', imagenInput.files[0]);
    parametros.append('costo_u', costo_unitarioTxt.value);
    parametros.append('precio_v', precio_ventaTxt.value);
    parametros.append('descripcion', descripcionTxt.value);
    parametros.append('disponible', Number(disponibleCHK.checked));
    parametros.append('opcion', 'editar');

    $.ajax({
            data : parametros,
            url: '../Controlador/gestion_productos.php',
            type: 'POST',            
            contentType: false, //desactivar para que jQuery no lo configure incorrectamente
            processData: false, //desactivar para que jQuery no convierta FormData en cadena

        beforeSend: function()
        {
            $('#mostrarProductos').html("Error de comunicación");
            listarProductos();
        },

        success: function(mensaje)
        {   
            $('#mostrarProductos').html(mensaje);
            listarProductos();
        }
    });
    listarProductos();
}

function actualizarDisponible(id){
     
    var disponibleCHK = document.getElementById('disponibleCHK'+id);
    var disponible = Number(disponibleCHK.checked);

    var parametros = 
    {
        "id" : id,
        "disponible" : disponible,
        "opcion" : 'estado'
    };  

    $.ajax({
        data : parametros,
        url: '../Controlador/gestion_productos.php',
        type: 'POST', 
    beforeSend: function()
    {
    },

    success: function(mensaje)
    {   

    }
});

}


function eliminarProductos(id){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar el producto: "+id+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id,
            "opcion" : 'eliminar'
        };                
 
        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_productos.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#mostrar_mensaje').html("Error! No se puede realizar la operación.");
        $('#mostrar_mensaje').css('color', 'red');
        listarProductos();
        },

        success: function(mensaje)
        {
        $('#mostrar_mensaje').html(mensaje);
        listarProductos();
        }
        
        });
        listarProductos();

    }
    
}

function agregarProductos(event)
{ 
    event.preventDefault(); // Evita que el formulario se envíe a la nada

    // rescatar valores del form
    var formulario = document.getElementById('formAgregarProductos');
    var nombre_producto = formulario.elements['nombre_producto'].value;
    var codigo_producto = formulario.elements['codigo_producto'].value;
    var imagen = formulario.elements['imagen'];
    var TipoProd = formulario.elements['TipoProd'].value;
    var costo_unitario = formulario.elements['costo_unitario'].value;
    var precio_venta = formulario.elements['precio_venta'].value;
    var descripcion = formulario.elements['descripcion'].value;
    var disponible = formulario.elements['disponible'].checked;

    

    var parametros = new FormData();
    parametros.append('nombre', nombre_producto);
    parametros.append('codigo', codigo_producto);
    parametros.append('imagen', imagen.files[0]);
    parametros.append('tipo', TipoProd);
    parametros.append('costo_u', costo_unitario);
    parametros.append('precio_v', precio_venta);
    parametros.append('descripcion', descripcion);
    parametros.append('disponible', Number(disponible));
    parametros.append('opcion', 'guardar');

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_productos.php',
        type: 'POST',
        contentType: false, //desactivar para que jQuery no lo configure incorrectamente
        processData: false, //desactivar para que jQuery no convierta FormData en cadena

            
        beforeSend: function()
        {
        //$('#mostrar_mensaje').html("Error de comunicación");
        listarProductos();
        },

        success: function(mensaje)
        {
        //$('#mostrar_mensaje').html(mensaje);
        listarProductos();
        cerrarPopup();
        document.getElementById("formAgregarProductos").reset();
        }
    });
}

//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------              GESTION CATEGORIAS          ----------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->

function listarTiposP(){
    var parametros =
    {
        "opcion":"listar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_productos.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#listarTipoDIV').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#listarTipoDIV').html(mensaje);
        }
    });
}

function mostrarTiposP(){
    var parametros =
    {
        "opcion":"mostrar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_tipo_producto.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#verTipoP').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#verTipoP').html(mensaje);
        }
    });
}

function agregarTiposP(event){ 
    
    event.preventDefault(); // Evita que el formulario se envíe a la nada
    // rescatar valores del form
    var formulario = document.getElementById('formCat');    
    var nombre = formulario.elements['nombre'].value;

    var parametros = 
    {
        "nombre" : nombre,
        "opcion" : 'guardar'
    };
    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_tipo_producto.php',
        type: 'POST',
        
        beforeSend: function()
        {
            mostrarTiposP();
        },

        success: function(mensaje)
        {           
            mostrarTiposP();
        }
        
    });
    
    document.getElementById("formCat").reset(); //limpia formulario
    mostrarTiposP();

}

function editarTipoP(id) {

    var tipoProdSpan = document.getElementById('nombre_tipoSpan'+id);
    var tipoProdTxt = document.getElementById('nombre_tipoTxt'+id);
    var btnEdit = document.getElementById('btnEditTipo'+id);
    var btnOK = document.getElementById('guardarTipoEdit'+id);    

    // Mostrar el campo de texto y ocultar el span
    tipoProdSpan.style.display = 'none';
    tipoProdTxt.style.display = 'inline';
    btnEdit.style.display = 'none';
    btnOK.style.display = 'inline';
}

function guardarTipoPEdit(id){

    var tipoProdSpan = document.getElementById('nombre_tipoSpan'+id);
    var tipoProdTxt = document.getElementById('nombre_tipoTxt'+id);
    var btnEdit = document.getElementById('btnEditTipo'+id);
    var btnOK = document.getElementById('guardarTipoEdit'+id);


    var parametros = 
    {
        "id" : id,
        "nombre" : tipoProdTxt.value,
        "opcion" : 'editar'
    };
    tipoProdSpan.style.display = 'inline';
    tipoProdTxt.style.display = 'none';
    btnEdit.style.display = 'inline';
    btnOK.style.display = 'none';

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_tipo_producto.php',
        type: 'POST',
        
        beforeSend: function()
        {
            mostrarTiposP();
        },

        success: function(mensaje)
        {
            mostrarTiposP();
        }

    });
    mostrarTiposP();
}

function eliminarTipoP(id){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar el tipo: "+id+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id,
            "opcion" : 'eliminar'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_tipo_producto.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#verTipoP').html("Error! No se puede realizar la operación.");
        $('#verTipoP').css('color', 'red');
        },

        success: function(mensaje)
        {
        $('#verTipoP').html(mensaje);
        mostrarTiposP();
        }
        
        });
        mostrarTiposP();

    }
}


//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------             GESTION PROMOCIONES          ----------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->



var productos = []; // Array para almacenar los elementos creados

function agregarOtroProducto() {
    var productoClone = document.querySelector('.producto').cloneNode(true);
    var selectProducto = productoClone.querySelector('select');
    var cantidadProducto = productoClone.querySelector('input');

    // Asignar un ID único al clon
    selectProducto.id = 'selectProducto' + (productos.length + 1);

    document.getElementById('productosContainer').appendChild(productoClone);

    // Agregar el nuevo elemento al array
    productos.push({
        select: selectProducto,
        cantidad: cantidadProducto
    });
}

function eliminarProducto(elemento) {
    var contenedorProducto = elemento.parentNode.parentNode;
    var selectProducto = contenedorProducto.querySelector('select');

    // Verificar cuántos elementos hay antes de eliminar
    if (productos.length > 1) {
        contenedorProducto.parentNode.removeChild(contenedorProducto);

        // Eliminar el elemento del array
        var index = productos.findIndex(producto => producto.select === selectProducto);
        if (index !== -1) {
            productos.splice(index, 1);
        }
    } else {
        alert("Debes dejar al menos un producto.");
    }
}

function enviarDatosPorAjax() {
    // Lógica para enviar los datos por AJAX
    // Aquí puedes usar 'productos' para acceder a los elementos selectProducto y cantidadProducto

    // Ejemplo de uso:
    for (var i = 0; i < productos.length; i++) {
        var producto = productos[i];
        console.log('Elemento:', producto.select.value);
        console.log('Cantidad:', producto.cantidad.value);
        // Aquí puedes agregar la lógica para enviar los datos al servidor
    }

    // Alerta de prueba
    alert('Datos enviados por AJAX');
}
