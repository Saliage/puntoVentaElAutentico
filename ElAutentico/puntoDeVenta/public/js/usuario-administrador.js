
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
        gestionarRol(2);
        listarTrabajadores();
        mostrarRoles();
    }


    function  mostrarRoles(){
        var parametros = 
        {
            "opcion" : "mostrar"
        };
    
        $.ajax({
            data : parametros,
            url: 'gestion/gestion_rol.php',
            type: 'POST',
            beforeSend: function() {
                $('#mostrarRoles').html("No roles para mostrar");
            },
            success: function(mensaje) {
                $('#mostrarRoles').html(mensaje);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown); //ver errores
            }
        });
    }



//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------           GESTION TRABAJADORES           ----------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->



function listarTrabajadores() {

    var parametros = 
    {
        "opcion" : "mostrar"
    };
    
    $.ajax({
        data : parametros,
        url: 'gestion/gestion_trabajador.php',
        type: 'POST',
        beforeSend: function() {
            //$('#mostrarTrabajadores').html("No hay trabajadores para mostrar");
        },
        success: function(mensaje) {
            $('#mostrarTrabajadores').html(mensaje);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown); //ver errores
        }
    });
}

function editarUsuario(id){

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

    // Mostrar el campo de texto y ocultar el span

    rutSpan.style.display = 'none';
    nombreSpan.style.display = 'none';
    apellidoSpan.style.display = 'none';
    usuarioSpan.style.display = 'none';
    claveSpan.style.display = 'none';
    estadoSpan.style.display = 'none';
    rolSpan.style.display = 'none';
    btnUserEdit.style.display = 'none';
    verClave.style.display = 'none';

    rutTxt.style.display = 'inline';
    nombreTxt.style.display = 'inline';
    apellidoTxt.style.display = 'inline';
    usuarioTxt.style.display = 'inline';
    claveTxt.style.display = 'inline';
    estadoSelect.style.display = 'inline';
    rolSelect.style.display = 'inline';
    guardarUsuarioEdit.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    
    rutTxt = rutSpan.innerText;
    nombreTxt = nombreSpan.innerText;
    apellidoTxt = apellidoSpan.innerText;
    usuarioTxt = usuarioSpan.innerText;
    claveTxt = claveSpan.innerText;

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
        url: 'gestion/gestion_trabajador.php',
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
        url: 'gestion/gestion_trabajador.php',
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

    }
    
}

function mostrarClave(id) {

    var claveSpan = document.getElementById('claveSpan'+id);
    var iconoVer = document.getElementById('ver'+id);

    if (claveSpan.style.display === 'none') {
        claveSpan.style.display = 'inline';
        iconoVer.setAttribute('name', 'eye-off-outline');
    } else {
        claveSpan.style.display = 'none';
        iconoVer.setAttribute('name', 'eye-outline');
    }
}



function agregarTrabajador(event)
{ 
    event.preventDefault(); // Evita que el formulario se envíe a la nada

    // rescatar valores del form
    var formulario = document.getElementById('formAgregarTrabajador');
    var rut = formulario.elements['rut'].value;
    var nombre = formulario.elements['nombre'].value;
    var apellido = formulario.elements['apellido'].value;
    var usuario = formulario.elements['usuario'].value;
    var clave = formulario.elements['clave'].value;
    var estado = 1; //siempre se agregarán los usuarios en estado "activos"
    var rol = formulario.elements['rol'].value;

    var parametros = 
    {
        "rut" : rut,
        "nombre" : nombre,
        "apellido" : apellido,
        "usuario" : usuario,
        "clave" : clave,
        "estado" : estado,
        "rol" : rol,
        "opcion" : 'guardar'
    };

$.ajax({
    data: parametros,
    url: 'gestion/gestion_trabajador.php',
    type: 'POST',
    
    beforeSend: function()
    {
    //$('#mostrar_mensaje').html("Error de comunicación");
    listarTrabajadores();
    },

    success: function(mensaje)
    {
    //$('#mostrar_mensaje').html(mensaje);
    alert(mensaje);
    listarTrabajadores();
    cerrarPopup();
    document.getElementById("formAgregarTrabajador").reset();
    }
});
}


//--------------------------------------------------------------------------------------------------------------------------------------->
//----------------------------------------------               GESTION ROLES              ----------------------------------------------->
//--------------------------------------------------------------------------------------------------------------------------------------->





function gestionarRol(opcion)
{ 
    buscar = document.getElementById('buscador').value;
var parametros = 
{
    "nombre" : buscar,
    "opcion" : opcion
};

$.ajax({
    data: parametros,
    url: 'gestion/gestion_rol.php',
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
    url: 'gestion/gestion_rol.php',
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
        url: 'gestion/gestion_rol.php',
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




