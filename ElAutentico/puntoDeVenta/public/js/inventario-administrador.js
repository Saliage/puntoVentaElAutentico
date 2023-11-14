
//funcion "onload" la principal que llama a las demás funciones necesarias para completar
// los formularios que requieren datos desde la BD
function inicializar(){

    listarAlmacenes();
    mostrarZonas();
    mostrarAlmacenes();
    mostrarCategorias();
    mostrarProveedores();
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

//------------------------------------------------------------------------------------------
//------------------------     LOGICA POPUP PROVEEDORES    ---------------------------------
//------------------------------------------------------------------------------------------

function agregarProveedor(event)
{ 
    event.preventDefault(); // Evita que el formulario se envíe a la nada

    // rescatar valores del form
    var formulario = document.getElementById('formAgregarProveedor');    
    var nombre = formulario.elements['nombre'].value;
    var rut = formulario.elements['rut'].value;
    var fono = formulario.elements['fono'].value;
    var email = formulario.elements['email'].value;
    var direccion = formulario.elements['direccion'].value;

    var parametros = 
    {
        "nombre" : nombre,
        "rut" : rut,
        "fono" : fono,
        "email" : email,
        "direccion" : direccion,
        "opcion" : 'guardar'
    };

$.ajax({
    data: parametros,
    url: '../Controlador/gestion_proveedor.php',
    type: 'POST',
    
    beforeSend: function()
    {
    //$('#mostrar_mensaje').html("Error de comunicación");
    mostrarProveedores();
    },

    success: function(mensaje)
    {
    mostrarProveedores();
    document.getElementById("formAgregarProveedor").reset(); //limpia formulario
    }
});
}

function mostrarProveedores(){
    var parametros =
    {
        "opcion":"mostar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_proveedor.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#verProveedores').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#verProveedores').html(mensaje);
        }
    });
}

function editarProveedores(id) {

    //rescatar elementos a tratar
    var nombre_proveedorSpan = document.getElementById('nombre_proveedorSpan'+id);
    var nombre_proveedorTxt = document.getElementById('nombre_proveedorTxt'+id);
    var rut_proveedorSpan = document.getElementById('rut_proveedorSpan'+id);
    var rut_proveedorTxt = document.getElementById('rut_proveedorTxt'+id);
    var fono_proveedorSpan = document.getElementById('fono_proveedorSpan'+id);
    var fono_proveedorTxt = document.getElementById('fono_proveedorTxt'+id);
    var email_proveedorSpan = document.getElementById('email_proveedorSpan'+id);
    var email_proveedorTxt = document.getElementById('email_proveedorTxt'+id);
    var direccion_proveedorSpan = document.getElementById('direccion_proveedorSpan'+id);
    var direccion_proveedorTxt = document.getElementById('direccion_proveedorTxt'+id);
    var btnEdit = document.getElementById('btnEditproveedor'+id);
    var btnOK = document.getElementById('guardarEditproveedor'+id);
     

    // Mostrar el campo de texto y ocultar el span
    nombre_proveedorSpan .style.display ='none';   
    nombre_proveedorTxt.style.display ='inline';
     rut_proveedorSpan.style.display ='none';
     rut_proveedorTxt.style.display ='inline';
     fono_proveedorSpan.style.display ='none';
     fono_proveedorTxt.style.display ='inline';
     email_proveedorSpan.style.display ='none';
     email_proveedorTxt.style.display ='inline';
     direccion_proveedorSpan.style.display ='none';
     direccion_proveedorTxt.style.display ='inline';
    btnEdit.style.display = 'none';
    btnOK.style.display = 'inline';
}

function guardarProveedorEdit(id){

   //rescatar elementos a tratar
   var nombre_proveedorSpan = document.getElementById('nombre_proveedorSpan'+id);
   var nombre_proveedorTxt = document.getElementById('nombre_proveedorTxt'+id);
   var rut_proveedorSpan = document.getElementById('rut_proveedorSpan'+id);
   var rut_proveedorTxt = document.getElementById('rut_proveedorTxt'+id);
   var fono_proveedorSpan = document.getElementById('fono_proveedorSpan'+id);
   var fono_proveedorTxt = document.getElementById('fono_proveedorTxt'+id);
   var email_proveedorSpan = document.getElementById('email_proveedorSpan'+id);
   var email_proveedorTxt = document.getElementById('email_proveedorTxt'+id);
   var direccion_proveedorSpan = document.getElementById('direccion_proveedorSpan'+id);
   var direccion_proveedorTxt = document.getElementById('direccion_proveedorTxt'+id);
   var btnEdit = document.getElementById('btnEditproveedor'+id);
   var btnOK = document.getElementById('guardarEditproveedor'+id);
   
   var parametros = 
   {
        "id" : $id,
       "nombre" : nombre_proveedorTxt.value,
       "rut" : rut_proveedorTxt.value,
       "fono" : fono_proveedorTxt.value,
       "email" : email_proveedorTxt.value,
       "direccion" : direccion_proveedorTxt.value,
       "opcion" : 'editar'
   };
    // revertir estado
   nombre_proveedorSpan .style.display ='inline';   
   nombre_proveedorTxt.style.display ='none';
    rut_proveedorSpan.style.display ='inline';
    rut_proveedorTxt.style.display ='none';
    fono_proveedorSpan.style.display ='inline';
    fono_proveedorTxt.style.display ='none';
    email_proveedorSpan.style.display ='inline';
    email_proveedorTxt.style.display ='none';
    direccion_proveedorSpan.style.display ='inline';
    direccion_proveedorTxt.style.display ='none';
   btnEdit.style.display = 'inline';
   btnOK.style.display = 'none';

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_proveedor.php',
        type: 'POST',
        
        beforeSend: function()
        {
            mostrarProveedores();
        },

        success: function(mensaje)
        {
            mostrarProveedores();
        }
        
        

    });
    mostrarProveedores();
    
}

function eliminarProveedor(id){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar al proveedor: "+id+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id,
            "opcion" : 'eliminar'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_proveedor.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#verProveedores').html("Error! No se puede realizar la operación.");
        $('#verProveedores').css('color', 'red');
        mostrarProveedores();
        },

        success: function(mensaje)
        {
        $('#verProveedores').html(mensaje);
        mostrarProveedores();
        }
        
        });

        mostrarProveedores();

    }
}
