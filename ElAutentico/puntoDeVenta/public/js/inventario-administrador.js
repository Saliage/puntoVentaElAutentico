
//funcion "onload" la principal que llama a las demás funciones necesarias para completar
// los formularios que requieren datos desde la BD
function inicializar(){

    listarAlmacenes();
    mostrarZonas();
    mostrarAlmacenes();
    mostrarCategorias();
}

//------------------------------------------------------------------------------------------
//---------------------------    LOGICA POPUP ZONAS     ------------------------------------
//------------------------------------------------------------------------------------------


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

function mostrarZonas(){
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
        },

        success: function(mensaje)
        {
        $('#mostrarZonas').html(mensaje);
        }
    });
}

function agregarZona(){ 
    // rescatar valores del form
    var nombre = document.getElementById('nombreZonaTxt').value;
    var almacen_id = document.getElementById('almacen_id').value;

    var parametros = 
    {
        "nombre" : nombre,
        "almacen_id" : almacen_id,
        "opcion" : 'guardar'
    };
    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_zona.php',
        type: 'POST',
        
        beforeSend: function()
        {

        },

        success: function(mensaje)
        {            
            
        }
        
    });
    
    $('#nombreZonaTxt').val("");  // restablecer valor del campo
    mostrarZonas();
}


function editarZona(id_zona) {

    var zonaSpan = document.getElementById('nombre_zonaSpan'+id_zona);
    var zonaTxt = document.getElementById('nombre_zonaTxt'+id_zona);
    var almacenSpan = document.getElementById('alcenSpan'+id_zona);
    var almacenSelect= document.getElementById('almacenSelect'+id_zona);
    var btnOK = document.getElementById('guardarEditZona'+id_zona);
    var btnEdit = document.getElementById('btnEditZona'+id_zona);

    // Mostrar el campo de texto y ocultar el span
    zonaSpan.style.display = 'none';
    zonaTxt.style.display = 'inline';
    btnEdit.style.display = 'none';
    btnOK.style.display = 'inline';
    almacenSpan.style.display ='none';
    almacenSelect.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    zonaTxt.value = zonaSpan.innerText;

}

function guardarZonaEdit(id_zona){

    var zonaSpan = document.getElementById('nombre_zonaSpan'+id_zona);
    var zonaTxt = document.getElementById('nombre_zonaTxt'+id_zona);
    var almacenSpan = document.getElementById('alcenSpan'+id_zona);
    var almacenSelect= document.getElementById('almacenSelect'+id_zona);
    var btnOK = document.getElementById('guardarEditZona'+id_zona);
    var btnEdit = document.getElementById('btnEditZona'+id_zona);
  

    var parametros = 
    {
        "id" : id_zona,
        "nombre" : zonaTxt.value,
        "almacen" : almacenSelect.value,
        "opcion" : 'editar'
    };

    zonaSpan.style.display = 'inline';
    zonaTxt.style.display = 'none';
    btnEdit.style.display = 'inline';
    btnOK.style.display = 'none';    
    almacenSpan.style.display ='inline';
    almacenSelect.style.display = 'none';

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_zona.php',
        type: 'POST',
        
        beforeSend: function()
        {
        },

        success: function(mensaje)
        {
        }
        
        

    });
    mostrarZonas();
    
}


function eliminarZona(id_zona){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar la zona: "+id_zona+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id_zona,
            "opcion" : 'eliminar'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_zona.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#mostrarZonas').html("Error! No se puede realizar la operación.");
        $('#mostrarZonas').css('color', 'red');
        mostrarZonas();
        },

        success: function(mensaje)
        {
        $('#mostrarZonas').html(mensaje);
        mostrarZonas();
        }
        
        });

        mostrarZonas();

    }
}

//------------------------------------------------------------------------------------------
//-------------------------    LOGICA POPUP ALMACENES    -----------------------------------
//------------------------------------------------------------------------------------------

function mostrarAlmacenes(){
    var parametros =
    {
        "opcion":"mostar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_almacen.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#verAlmacenes').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#verAlmacenes').html(mensaje);
        }
    });
}

function agregarAlmacen(){ 
    // rescatar valores del form
    var nombre = document.getElementById('nombreAlmacenTxt').value;

    var parametros = 
    {
        "nombre" : nombre,
        "opcion" : 'guardar'
    };
    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_almacen.php',
        type: 'POST',
        
        beforeSend: function()
        {

        },

        success: function(mensaje)
        {            
            
        }
        
    });
    
    $('#nombreAlmacenTxt').val("");  // restablecer valor del campo
    mostrarAlmacenes();

}

function editarAlmacen(id_almacen) {

    var almacenSpan = document.getElementById('nombre_almacenSpan'+id_almacen);
    var almacenTxt = document.getElementById('nombre_almacenTxt'+id_almacen);
    var btnOK = document.getElementById('guardarEditAlmacen'+id_almacen);
    var btnEdit = document.getElementById('btnEditAlmacen'+id_almacen);

    // Mostrar el campo de texto y ocultar el span
    almacenSpan.style.display = 'none';
    almacenTxt.style.display = 'inline';
    btnEdit.style.display = 'none';
    btnOK.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    almacenTxt.value = almacenSpan.innerText;

}

function guardarAlmacenEdit(id_almacen){

    var almacenSpan = document.getElementById('nombre_almacenSpan'+id_almacen);
    var almacenTxt = document.getElementById('nombre_almacenTxt'+id_almacen);
    var btnOK = document.getElementById('guardarEditAlmacen'+id_almacen);
    var btnEdit = document.getElementById('btnEditAlmacen'+id_almacen);


    var parametros = 
    {
        "id" : id_almacen,
        "nombre" : almacenTxt.value,
        "opcion" : 'editar'
    };
    almacenSpan.style.display = 'inline';
    almacenTxt.style.display = 'none';
    btnEdit.style.display = 'inline';
    btnOK.style.display = 'none';

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_almacen.php',
        type: 'POST',
        
        beforeSend: function()
        {
        },

        success: function(mensaje)
        {
        }
        
        

    });
    mostrarAlmacenes();
    
}

function eliminarAlmacen(id_almacen){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar el almacen: "+id_almacen+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id_almacen,
            "opcion" : 'eliminar'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_almacen.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#verAlmacenes').html("Error! No se puede realizar la operación.");
        $('#verAlmacenes').css('color', 'red');
        mostrarAlmacenes();
        },

        success: function(mensaje)
        {
        $('#verAlmacenes').html(mensaje);
        mostrarAlmacenes();
        }
        
        });

        mostrarAlmacenes();

    }
}

//------------------------------------------------------------------------------------------
//------------------------     LOGICA POPUP CATEGORIAS     ---------------------------------
//------------------------------------------------------------------------------------------

function mostrarCategorias(){
    var parametros =
    {
        "opcion":"mostar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_categoriaInsumo.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#verCategorias').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#verCategorias').html(mensaje);
        }
    });
}

function agregarCategoria(){ 
    // rescatar valores del form
    var nombre = document.getElementById('nombreCategoriaTxt').value;

    var parametros = 
    {
        "nombre" : nombre,
        "opcion" : 'guardar'
    };
    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_categoriaInsumo.php',
        type: 'POST',
        
        beforeSend: function()
        {

        },

        success: function(mensaje)
        {            
            
        }
        
    });
    
    $('#nombreCategoriaTxt').val("");  // restablecer valor del campo
    mostrarCategorias();
}

function editarCategoria(id_categoria) {

    var CategoriaSpan = document.getElementById('nombre_CategoriaSpan'+id_categoria);
    var CategoriaTxt = document.getElementById('nombre_CategoriaTxt'+id_categoria);
    var btnOK = document.getElementById('guardarEditCategoria'+id_categoria);
    var btnEdit = document.getElementById('btnEditCategoria'+id_categoria);

    // Mostrar el campo de texto y ocultar el span
    CategoriaSpan.style.display = 'none';
    CategoriaTxt.style.display = 'inline';
    btnEdit.style.display = 'none';
    btnOK.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    CategoriaTxt.value = CategoriaSpan.innerText;

}

function guardarCategoriaEdit(id_categoria){

    var CategoriaSpan = document.getElementById('nombre_CategoriaSpan'+id_categoria);
    var CategoriaTxt = document.getElementById('nombre_CategoriaTxt'+id_categoria);
    var btnOK = document.getElementById('guardarEditCategoria'+id_categoria);
    var btnEdit = document.getElementById('btnEditCategoria'+id_categoria);


    var parametros = 
    {
        "id" : id_categoria,
        "nombre" : CategoriaTxt.value,
        "opcion" : 'editar'
    };
    CategoriaSpan.style.display = 'inline';
    CategoriaTxt.style.display = 'none';
    btnEdit.style.display = 'inline';
    btnOK.style.display = 'none';

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_categoriaInsumo.php',
        type: 'POST',
        
        beforeSend: function()
        {
            mostrarCategorias();
        },

        success: function(mensaje)
        {
            mostrarCategorias();
        }
        
        

    });
    mostrarCategorias();
    
}

function eliminarCategoria(id_categoria){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar el Categoria: "+id_categoria+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id_categoria,
            "opcion" : 'eliminar'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_categoriaInsumo.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#verCategorias').html("Error! No se puede realizar la operación.");
        $('#verCategorias').css('color', 'red');
        mostrarCategorias();
        },

        success: function(mensaje)
        {
        $('#verCategorias').html(mensaje);
        mostrarCategorias();
        }
        
        });

        mostrarCategorias();

    }
}
