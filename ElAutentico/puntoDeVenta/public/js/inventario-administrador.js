
//funcion "onload" la principal que llama a las demás funciones necesarias para completar
// los formularios que requieren datos desde la BD
function inicializar(){

    listarAlmacenes();
    listarZonas();

}


function listarAlmacenes(){
    var parametros =
    {
        "opcion":"cargarAlmacenes"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_zona.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#slectAlmacenes').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#slectAlmacenes').html(mensaje);
        }
    });
}

function listarZonas(){
    var parametros =
    {
        "opcion":"cargarZonas"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_zona.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#mostrarZonas').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#mostrarZonas').html(mensaje);
        }
    });
}

function addZona(){ 
    // rescatar valores del form
    var nombre = document.getElementById('nombreZonaTxt').value;
    var almacen_id = document.getElementById('almacen_id').value;

    alert("se recibe: "+nombre+' '+almacen_id);
    var parametros = 
    {
        "nombre" : nombre,
        "' '+" : almacen_id,
        "opcion" : 'guardar'
    };
    alert("se envia: "+nombre+almacen_id);
    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_zona.php',
        type: 'POST',
        
        beforeSend: function()
        {
        alert("se envia");
        },

        success: function(mensaje)
        {
            alert(mensaje);
            
        }
        
    });
    listarZonas();

}









