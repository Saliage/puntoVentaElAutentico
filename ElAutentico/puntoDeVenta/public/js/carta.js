
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
        gestionarTipo_producto(2);
        listarCat();
        mostrarTipo_producto();
    }


    function  mostrarTipo_producto(){
        var parametros = 
        {
            "opcion" : "mostrar"
        };
    
        $.ajax({
            data : parametros,
            url: '../Controlador/gestion_carta.php',
            type: 'POST',
            beforeSend: function() {
                $('#mostrarTipo_producto').html("No tipo_categorias para mostrar");
            },
            success: function(mensaje) {
                $('#mostrarTipo_producto').html(mensaje);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown); //ver errores
            }
        });
    }



//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------           GESTION TRABAJADORES           ----------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->



function listarCat() {

    var parametros = 
    {
        "opcion" : "mostrar"
    };
    
    $.ajax({
        data : parametros,
        url: '../Controlador/gestion_carta.php',
        type: 'POST',
        beforeSend: function() {
            //$('#mostrarProductos').html("No hay trabajadores para mostrar");
        },
        success: function(mensaje) {
            $('#mostrarProductos').html(mensaje);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown); //ver errores
        }
    });
}

function editarCategoria(id){

    var nombre_productoSpan = document.getElementById('nombre_productoSpan'+id);
    var codigo_productoSpan = document.getElementById('codigo_productoSpan'+id);
    var imagenSpan = document.getElementById('imagenSpan'+id);
    var costo_unitarioSpan = document.getElementById('costo_unitarioSpan'+id);
    var precio_ventaSpan = document.getElementById('precio_ventaSpan'+id);
    var descripcionSpan = document.getElementById('descripcionSpan'+id);
    var btnCategoriaEdit = document.getElementById('btnCategoriaEdit'+id);

    var nombre_productoTxt = document.getElementById('nombre_productoTxt'+id);
    var codigo_productoTxt = document.getElementById('codigo_productoTxt'+id);
    var imagenTxt = document.getElementById('imagenTxt'+id);
    var costo_unitarioTxt = document.getElementById('costo_unitarioTxt'+id);
    var precio_ventaTxt = document.getElementById('precio_ventaTxt'+id);
    var descripcionSelect = document.getElementById('descripcionSelect'+id);
    var guardarCategoriaEdit = document.getElementById('guardarCategoriaEdit'+id);

    // Mostrar el campo de texto y ocultar el span

    nombre_productoSpan.style.display = 'none';
    codigo_productoSpan.style.display = 'none';
    imagenSpan.style.display = 'none';
    costo_unitarioSpan.style.display = 'none';
    precio_ventaSpan.style.display = 'none';
    descripcionSpan.style.display = 'none';
    btnCategoriaEdit.style.display = 'none';

    nombre_productoTxt.style.display = 'inline';
    codigo_productoTxt.style.display = 'inline';
    imagenTxt.style.display = 'inline';
    costo_unitarioTxt.style.display = 'inline';
    precio_ventaTxt.style.display = 'inline';
    descripcionTxt.style.display = 'inline';
    guardarCategoriaEdit.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    
    nombre_productoTxt = nombre_productoSpan.innerText;
    codigo_productoTxt = codigo_productoSpan.innerText;
    imagenTxt = imagenSpan.innerText;
    costo_unitarioTxt = costo_unitarioSpan.innerText;
    precio_ventaTxt = precio_ventaSpan.innerText;
    descripcionTxt = descripcionSpan.innerText;

}

function guardarUsuarioEdit(id){

    var rutSpan = document.getElementById('rutSpan'+id);
    var nombreSpan = document.getElementById('nombreSpan'+id);
    var apellidoSpan = document.getElementById('apellidoSpan'+id);
    var usuarioSpan = document.getElementById('usuarioSpan'+id);
    var claveSpan = document.getElementById('claveSpan'+id);
    var estadoSpan = document.getElementById('estadoSpan'+id);
    var rolSpan = document.getElementById('rolSpan'+id);
    var btnUserEdit = document.getElementById('btnUserEdit'+id);
    var verClave = document.getElementById('verClave'+id);

    var rutTxt = document.getElementById('rutTxt'+id);
    var nombreTxt = document.getElementById('nombreTxt'+id);
    var apellidoTxt = document.getElementById('apellidoTxt'+id);
    var usuarioTxt = document.getElementById('usuarioTxt'+id);
    var claveTxt = document.getElementById('claveTxt'+id);
    var estadoSelect = document.getElementById('estadoSelect'+id);
    var rolSelect = document.getElementById('rolSelect'+id);
    var guardarUsuarioEdit = document.getElementById('guardarUsuarioEdit'+id);


    var parametros = 
    {
        "id" : id,
        "rut" : rutTxt.value,
        "nombre" : nombreTxt.value,
        "apellido" : apellidoTxt.value,
        "usuario" : usuarioTxt.value,
        "clave" : claveTxt.value,
        "estado" : estadoSelect.value,
        "rol" : rolSelect.value,
        "opcion" : 'U'
    };

    //volver inputs a su estado anterior

    rutSpan.style.display = 'inline';
    nombreSpan.style.display = 'inline';
    apellidoSpan.style.display = 'inline';
    usuarioSpan.style.display = 'inline';
    claveSpan.style.display = 'inline';
    estadoSpan.style.display = 'inline';
    rolSpan.style.display = 'inline';
    btnUserEdit.style.display = 'inline';
    verClave.style.display = 'inline';
    
    rutTxt.style.display = 'none';
    nombreTxt.style.display = 'none';
    apellidoTxt.style.display = 'none';
    usuarioTxt.style.display = 'none';
    claveTxt.style.display = 'none';
    estadoSelect.style.display = 'none';
    rolSelect.style.display = 'none';
    guardarUsuarioEdit.style.display = 'none';
    

$.ajax({
        data : parametros,
        url: '../Controlador/gestion_trabajador.php',
        type: 'POST',
    beforeSend: function()
    {
    $('#mostrarTrabajadores').html("Error de comunicación");
    listarTrabajadores();
    },

    success: function(mensaje)
    {
    $('#mostrarTrabajadores').html(mensaje);
    listarTrabajadores();
    }
    

});

}

function eliminarUsuario(id){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar al trabajador: "+id+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id,
            "opcion" : 'D'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_trabajador.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#mostrar_mensaje').html("Error! No se puede realizar la operación.");
        $('#mostrar_mensaje').css('color', 'red');
        listarTrabajadores();
        },

        success: function(mensaje)
        {
        $('#mostrar_mensaje').html(mensaje);
        listarTrabajadores();
        }
        
        });
        listarTrabajadores();

    }
    
}


function agregarProducto(event)
{ 
    event.preventDefault(); // Evita que el formulario se envíe a la nada

    // rescatar valores del form
    var formulario = document.getElementById('formAgregarProducto');
    var nombre_producto = formulario.elements['nombre_producto'].value;
    var codigo_producto = formulario.elements['codigo_producto'].value;
    var imagen = formulario.elements['imagen'].value;
    var costo_unitario = formulario.elements['costo_unitario'].value;
    var precio_venta = formulario.elements['precio_venta'].value;
    var descripcion = formulario.elements['descripcion'].value;
    
    var parametros = 
        {
            "nombre_producto" : nombre_producto,
            "codigo_producto" : codigo_producto,
            "imagen" : imagen,
            "costo_unitario" : costo_unitario,
            "precio_venta" : precio_venta,
            "descripcion" : descripcion,
            "opcion" : 'guardar'
        };

        $.ajax({
            data: parametros,
            url: '../Controlador/gestion_carta.php',
            type: 'POST',
            
            beforeSend: function()
            {
            //$('#mostrar_mensaje').html("Error de comunicación");
            listarCat();
            },

            success: function(mensaje)
            {
            //$('#mostrar_mensaje').html(mensaje);
            alert(mensaje);
            listarCat();
            cerrarPopup();
            document.getElementById("formAgregarProducto").reset();
            }
        });
}

//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------               GESTION ROLES              ----------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->


function gestionarTipo_producto(opcion)
{ 
    buscar = document.getElementById('buscador').value;
var parametros = 
{
    "nombre" : buscar,
    "opcion" : opcion
};

$.ajax({
    data: parametros,
    url: '../Controlador/gestion_carta.php',
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


function editarRol(id_rol) {

    var rolSpan = document.getElementById('nombre_rolSpan'+id_rol);
    var rolTxt = document.getElementById('nombre_rolTxt'+id_rol);
    var btnOK = document.getElementById('guardarEdit'+id_rol);
    var btnEdit = document.getElementById('btnEdit'+id_rol);

    // Mostrar el campo de texto y ocultar el span
    rolSpan.style.display = 'none';
    rolTxt.style.display = 'inline';
    btnEdit.style.display = 'none';
    btnOK.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    rolTxt.value = rolSpan.innerText;

}

function guardarRolEdit(id_rol){

    var rolSpan = document.getElementById('nombre_rolSpan'+id_rol);
    var rolTxt = document.getElementById('nombre_rolTxt'+id_rol);
    var btnOK = document.getElementById('guardarEdit'+id_rol);
    var btnEdit = document.getElementById('btnEdit'+id_rol);
    var parametros = 
    {
        "id" : id_rol,
        "nombre" : rolTxt.value,
        "opcion" : 'U'
    };

    rolSpan.style.display = 'inline';
    rolTxt.style.display = 'none';
    btnEdit.style.display = 'inline';
    btnOK.style.display = 'none';
    gestionarRol(2);

$.ajax({
    data: parametros,
    url: '../Controlador/gestion_rol.php',
    type: 'POST',
    
    beforeSend: function()
    {
    $('#mostrar_mensaje').html("Error de comunicación");
    gestionarRol(2);
    },

    success: function(mensaje)
    {
    $('#mostrar_mensaje').html(mensaje);
    gestionarRol(2);
    }
    

});

    
}

function eliminarRol(id_rol){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar el rol: "+id_rol+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id_rol,
            "opcion" : 'D'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_rol.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#mostrar_mensaje').html("Error! No se puede realizar la operación.");
        $('#mostrar_mensaje').css('color', 'red');
        gestionarRol(2);
        },

        success: function(mensaje)
        {
        $('#mostrar_mensaje').html(mensaje);
        gestionarRol(2);
        }
        
        });

    }
        


}




