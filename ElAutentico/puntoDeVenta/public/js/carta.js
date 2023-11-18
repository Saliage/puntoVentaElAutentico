
// Función para mostrar el popup
function mostrarPopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'flex';
}


function cerrarPopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'none';

}

    function inicializar(){
        gestionarCategoria(2);
        listarProductos();
        mostrarCat();
    }

     ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////// MOSTRAR ROLES ////////////////////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
   function  mostrarCat(){
        var parametros = 
        {
            "opcion" : "mostrar"
        };
    
        $.ajax({
            data : parametros,
            url: '../Controlador/gestion_carta.php',
            type: 'POST',
            beforeSend: function() {
                $('#mostrarCat').html("No hay categorias para mostrar");
            },
            success: function(mensaje) {
                $('#mostrarCat').html(mensaje);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown); //ver errores
            }
        });
    }

//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------           GESTION TRABAJADORES           ----------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->

function listarProductos() {

    var parametros = 
    {
        "opcion" : "mostrar"
    };
    
    $.ajax({
        data : parametros,
        url: '../Controlador/gestion_carta.php',
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
    var imagenSpan = document.getElementById('imagenSpan'+id);
    var costo_unitarioSpan = document.getElementById('costo_unitarioSpan'+id);
    var precio_ventaSpan = document.getElementById('precio_ventaSpan'+id);
    var descripcionSpan = document.getElementById('descripcionSpan'+id);
    var categoriasSpan = document.getElementById('categoriasSpan'+id);
    var btnUserEdit = document.getElementById('btnUserEdit'+id);

    var nombre_productoTxt = document.getElementById('nombre_productoTxt'+id);
    var codigo_productoTxt = document.getElementById('codigo_productoTxt'+id);
    var imagenTxt = document.getElementById('imagenTxt'+id);
    var costo_unitarioTxt = document.getElementById('costo_unitarioTxt'+id);
    var precio_ventaTxt = document.getElementById('precio_ventaTxt'+id);
    var descripcionTxt = document.getElementById('descripcionTxt'+id);
    var categoriasSelect = document.getElementById('categoriasSelect'+id);
    var guardarUsuarioEdit = document.getElementById('guardarUsuarioEdit'+id);

    // Mostrar el campo de texto y ocultar el span

    nombre_productoSpan.style.display = 'none';
    codigo_productoSpan.style.display = 'none';
    imagenSpan.style.display = 'none';
    costo_unitarioSpan.style.display = 'none';
    precio_ventaSpan.style.display = 'none';
    descripcionSpan.style.display = 'none';
    categoriasSpan.style.display = 'none';
    btnUserEdit.style.display = 'none';

    nombre_productoTxt.style.display = 'inline';
    codigo_productoTxt.style.display = 'inline';
    imagenTxt.style.display = 'inline';
    costo_unitarioTxt.style.display = 'inline';
    precio_ventaTxt.style.display = 'inline';
    descripcionTxt.style.display = 'inline';
    categoriasSelect.style.display = 'inline';
    guardarUsuarioEdit.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    
    nombre_productoTxt = nombre_productoSpan.innerText;
    codigo_productoTxt = codigo_productoSpan.innerText;
    imagenTxt = imagenSpan.innerText;
    costo_unitarioTxt = costo_unitarioSpan.innerText;
    precio_ventaTxt = precio_ventaSpan.innerText;
    descripcionTxt = descripcionSpan.innerText;

}

function guardarUsuarioEdit(id){

    var nombre_productoSpan = document.getElementById('nombre_productoSpan'+id);
    var codigo_productoSpan = document.getElementById('codigo_productoSpan'+id);
    var imagenSpan = document.getElementById('imagenSpan'+id);
    var costo_unitarioSpan = document.getElementById('costo_unitarioSpan'+id);
    var precio_ventaSpan = document.getElementById('precio_ventaSpan'+id);
    var descripcionSpan = document.getElementById('descripcionSpan'+id);
    var categoriasSpan = document.getElementById('categoriasSpan'+id);
    var btnUserEdit = document.getElementById('btnUserEdit'+id);

    var nombre_productoTxt = document.getElementById('nombre_productoTxt'+id);
    var codigo_productoTxt = document.getElementById('codigo_productoTxt'+id);
    var imagenTxt = document.getElementById('imagenTxt'+id);
    var costo_unitarioTxt = document.getElementById('costo_unitarioTxt'+id);
    var precio_ventaTxt = document.getElementById('precio_ventaTxt'+id);
    var descripcionTxt = document.getElementById('descripcionTxt'+id);
    var categoriasSelect = document.getElementById('categoriasSelect'+id);
    var guardarUsuarioEdit = document.getElementById('guardarUsuarioEdit'+id);


    var parametros = 
    {
        "id" : id,
        "nombre_producto" : nombre_productoTxt.value,
        "codigo_producto" : codigo_productoTxt.value,
        "imagen" : imagenTxt.value,
        "costo_unitario" : costo_unitarioTxt.value,
        "precio_venta" : precio_ventaTxt.value,
        "descripcion" : descripcionTxt.value,
        "categorias" : categoriasSelect.value,
        "opcion" : 'U'
    };

    //volver inputs a su estado anterior

    nombre_productoSpan.style.display = 'inline';
    codigo_productoSpan.style.display = 'inline';
    imagenSpan.style.display = 'inline';
    costo_unitarioSpan.style.display = 'inline';
    precio_ventaSpan.style.display = 'inline';
    descripcionSpan.style.display = 'inline';
    categoriasSpan.style.display = 'inline';
    btnUserEdit.style.display = 'inline';
    
    nombre_productoTxt.style.display = 'none';
    codigo_productoTxt.style.display = 'none';
    imagenTxt.style.display = 'none';
    costo_unitarioTxt.style.display = 'none';
    precio_ventaTxt.style.display = 'none';
    descripcionTxt.style.display = 'none';
    categoriasSelect.style.display = 'none';
    guardarUsuarioEdit.style.display = 'none';
    

$.ajax({
        data : parametros,
        url: '../Controlador/gestion_carta.php',
        type: 'POST',
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

}

function eliminarProductos(id){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar el producto: "+id+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id,
            "opcion" : 'D'
        };                
 
        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_carta.php',
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
    var imagen = formulario.elements['imagen'].value;
    var costo_unitario = formulario.elements['costo_unitario'].value;
    var precio_venta = formulario.elements['precio_venta'].value;
    var descripcion = formulario.elements['descripcion'].value;
    var categorias = formulario.elements['categorias'].value;

    var parametros = 
    {
        "nombre_producto" : nombre_producto,
        "codigo_producto" : codigo_producto,
        "imagen" : imagen,
        "costo_unitario" : costo_unitario,
        "precio_venta" : precio_venta,
        "descripcion" : descripcion,
        "categorias" : categorias,
        "opcion" : 'guardar'
    };
    
    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_carta.php',
        type: 'POST',
            
        beforeSend: function()
        {
        //$('#mostrar_mensaje').html("Error de comunicación");
        listarProductos();
        },

        success: function(mensaje)
        {
        //$('#mostrar_mensaje').html(mensaje);
        alert(mensaje);
        listarProductos();
        cerrarPopup();
        document.getElementById("formAgregarProductos").reset();
        }
    });
}

//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------               GESTION ROLES              ----------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->


function gestionarCat(opcion)
{ 
    buscar = document.getElementById('buscador').value;
var parametros = 
{
    "nombre" : buscar,
    "opcion" : opcion
};

$.ajax({
    data: parametros,
    url: '../Controlador/carta.php',
    type: 'POST',
    
    beforesend: function()
    {
    $('#mostrar_mensaje').html("Error de comunicación");
    },

    success: function(mensaje)
    {
    $('#mostrar_mensaje').html(mensaje);
    }
});
}


function editarCat(id_tipo) {

    var categoriasSpan = document.getElementById('nombre_tipoSpan'+id_tipo);
    var categoriasTxt = document.getElementById('nombre_tipoTxt'+id_tipo);
    var btnOK = document.getElementById('guardarEdit'+id_tipo);
    var btnEdit = document.getElementById('btnEdit'+id_tipo);

    // Mostrar el campo de texto y ocultar el span
    categoriasSpan.style.display = 'none';
    categoriasTxt.style.display = 'inline';
    btnEdit.style.display = 'none';
    btnOK.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    categoriasTxt.value = categoriasSpan.innerText;

}

function guardarCatEdit(id_rol){

    var categoriasSpan = document.getElementById('nombre_tipoSpan'+id_rol);
    var categoriasTxt = document.getElementById('nombre_tipoTxt'+id_rol);
    var btnOK = document.getElementById('guardarEdit'+id_rol);
    var btnEdit = document.getElementById('btnEdit'+id_rol);
    var parametros = 
    {
        "id" : nombre_tipo,
        "nombre" : categoriasTxt.value,
        "opcion" : 'U'
    };

    categoriasSpan.style.display = 'inline';
    categoriasTxt.style.display = 'none';
    btnEdit.style.display = 'inline';
    btnOK.style.display = 'none';
    gestionarCat(2);

$.ajax({
    data: parametros,
    url: '../Controlador/gestion_carta.php',
    type: 'POST',
    
    beforeSend: function()
    {
    $('#mostrar_mensaje').html("Error de comunicación");
    gestionarCat(2);
    },

    success: function(mensaje)
    {
    $('#mostrar_mensaje').html(mensaje);
    gestionarCat(2);
    }
    

});

    
}

function eliminarCat(id_tipo){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar la categoria: "+id_tipo+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id_tipo,
            "opcion" : 'D'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_carta.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#mostrar_mensaje').html("Error! No se puede realizar la operación.");
        $('#mostrar_mensaje').css('color', 'red');
        gestionarCat(2);
        },

        success: function(mensaje)
        {
        $('#mostrar_mensaje').html(mensaje);
        gestionarCat(2);
        }
        
        });

    }
        


}




