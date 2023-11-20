

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



function nuevaSalidaInsumo(registro, insumo, nombre, formato, total) {
    // Cambiar el contenido de los spans
    document.getElementById('insumoSpan').textContent = insumo;
    document.getElementById('nombreSpan').textContent = nombre;
    document.getElementById('formatoSapn').textContent = formato;
    document.getElementById('cantidadSpan').textContent = total;

    var inputCantidad = document.querySelector('input[name="stock"]');
    inputCantidad.max = total;

    // Almacena los valores necesarios como atributos de datos en el formulario
    var formSalida = document.querySelector('.formularioSalida');
    formSalida.setAttribute('data-registro', registro);
    formSalida.setAttribute('data-insumo', insumo);
    

    // Mostrar el popup
    mostrarPopup9();
    document.querySelector('.formularioSalida').reset();
}

function registrarSalida(registro, insumo, descontar){

    document.getElementById('mensajeSpan').textContent = "Se descontaron "+descontar+" insumos con éxito";
    document.getElementById('alertaDiv').style.display = 'inline';
    document.getElementById('cerrarP').style.display = 'inline';


    var parametros = 
    {
        "registro":registro,
        "insumo":insumo,
        "descontar": descontar,
        "opcion" : "salida"
    };
    
    $.ajax({
        data : parametros,
        url: '../Controlador/gestion_inventario.php',
        type: 'POST',
        beforeSend: function() {
        },
        success: function(mensaje) {
            listarInventario();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown); //ver errores
        }
    });
    listarInventario();

}

// Definir el manejador de eventos una sola vez
document.addEventListener('DOMContentLoaded', function () {
    const formSalida = document.getElementById('formSalida');

    formSalida.addEventListener('submit', function (event) {
        event.preventDefault(); // Previene el comportamiento predeterminado del formulario

        // Obtén los valores almacenados como atributos de datos en el formulario
        const registro = formSalida.getAttribute('data-registro');
        const insumo = formSalida.getAttribute('data-insumo');
        const cantidadIngresada = document.getElementById('stock').value;

        // Llama a la función pasando los valores necesarios
        registrarSalida(registro, insumo, cantidadIngresada);
    });
});


