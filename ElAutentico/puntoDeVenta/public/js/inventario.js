

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

    var insumo = formulario.elements['insumo'].value;
    var cantidad = formulario.elements['cantidad'].value;
    var costo = formulario.elements['costo'].value;
    var zona_id = formulario.elements['zona_id'].value;
    var fechaInput = formulario.elements['fecha'];
   
    var fecha = null;
    //verificar si viene la fecha para enviar, sino envía null
    if(fechaInput && fechaInput.type === "date") {
        var fecha = fechaInput.value; //guarda valor de fecha
    }
    
    var parametros = 
    {
        "insumo" : insumo,
        "cantidad" : cantidad,
        "costo" : costo,
        "fecha" : fecha,
        "zona_id" : zona_id,
        "opcion" : 'guardar'
    };

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_inventario.php',
        type: 'POST',
        
        beforeSend: function()
        {
            listarInventario();
        },

        success: function(mensaje)
        {
        //$('#mostrar_mensaje').html(mensaje);
        listarInventario();
        cerrarPopup8();
        document.getElementById("formEntradaInsumo").reset();
        }
        
    });
        
}


function nuevaSalidaInsumo(registro, insumo, nombre, formato, cantidad) {
    // Cambiar el contenido de los spans

    //alert(registro+' '+insumo+' '+ nombre+' '+ formato+' '+ cantidad);
    document.getElementById('insumoSpan').textContent = insumo;
    document.getElementById('nombreSpan').textContent = nombre;
    document.getElementById('formatoSapn').textContent = formato;
    document.getElementById('cantidadSpan').textContent = cantidad;

    var inputCantidad = document.querySelector('input[name="stock"]');
    inputCantidad.max = cantidad;


    // Mostrar el popup
    mostrarPopup9();
    document.querySelector('.formularioSalida').reset();
    
}



