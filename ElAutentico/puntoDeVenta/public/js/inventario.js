

function inicializarInventario(){
    listarInventario();
    listarInsumosFormat();
    listarAlmacenes();
}

function listarAlmacenes(){
    var parametros =
    {
        "opcion":"listar2"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_almacen.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#listarAlmacenes').html("Error de comunicación");
        },

        success: function(mensaje)
        {
            
        $('#listarAlmacenes').html(mensaje);
        }
    });
}

function mostrarZonasAlmacen(){
    var almacen = document.getElementById('almacen_id2').value;

    var parametros =
    {
        "almacen":almacen,
        "opcion":"listar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_zona.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#listarZonas').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#listarZonas').html(mensaje);
        }
    });
}

function listarInventario() {

    var parametros = 
    {
        "opcion" : "mostrar"
    };
    
    $.ajax({
        data : parametros,
        url: '../Controlador/gestion_inventario.php',
        type: 'POST',
        beforeSend: function() {
            //$('#mostrarTrabajadores').html("No hay trabajadores para mostrar");
        },
        success: function(mensaje) {
            $('#mostrarInventario').html(mensaje);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown); //ver errores
        }
    });
}



function listarInsumosFormat(){
    var parametros =
    {
        "opcion":"listar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_insumo.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#listarInsumos').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#listarInsumos').html(mensaje);
        }
    });

}

function reqFecVen(){
    
    var insumoSelect = document.getElementById("insumo");
    var selectedOption = insumoSelect.options[insumoSelect.selectedIndex];
    var perecible = selectedOption.getAttribute("data-perecible");
    var verCampos = document.getElementById("fec_ven");
    

    if(perecible == 1){

        verCampos.style.display ='inline';
        var parametros =
        {
            "perecible":perecible,
            "opcion":"validar"
        }

        $.ajax({
            data: parametros,
            url: '../Controlador/gestion_inventario.php',
            type: 'POST',
            
            beforesend: function()
            {
                $('#pedirFec_ven').html("Error de comunicación");
            },

            success: function(mensaje)
            {
                $('#pedirFec_ven').html(mensaje);
            }
        });
    }else{
        verCampos.style.display ='none';
        $('#pedirFec_ven').html("");
    }
    

}







function entradaInsumo(event)
{ 
    event.preventDefault(); // Evita que el formulario se envíe a la nada

    // rescatar valores del form
    var formulario = document.getElementById('formEntradaInsumo');
    var rut = formulario.elements['rut'].value;
    var nombre = formulario.elements['nombre'].value;
    var apellido = formulario.elements['apellido'].value;
    var usuario = formulario.elements['usuario'].value;
    var clave = formulario.elements['clave'].value;
    var estado = 1; //siempre se agregarán los usuarios en estado "activos"
    var rol = formulario.elements['rol'].value;

    if(validarRut(rut)){

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
            url: '../Controlador/gestion_trabajador.php',
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
            document.getElementById("formEntradaInsumo").reset();
            }
        });
    }
    else{
        
        $('#validaRUT').html('El RUT no es válido. Por favor, corrige el RUT.');
        document.getElementById("rut").value ="";
    }
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




