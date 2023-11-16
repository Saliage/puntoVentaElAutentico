

function inicializar(){
        
    mostrarFormatos();
    listarFormatos();
    listarCtaegorias();
    mostrarCategorias();
    mostrarInsumos();

}




//------------------------------------------------------------------------------------------
//-------------------------    LOGICA POPUP INSUMOS      -----------------------------------
//------------------------------------------------------------------------------------------

function listarFormatos(){
    var parametros =
    {
        "opcion":"listar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_formato.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#listarFormatos').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#listarFormatos').html(mensaje);
        }
    });
}

function listarCtaegorias(){
    var parametros =
    {
        "opcion":"listar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_categoriaInsumo.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#listarCategoria').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#listarCategoria').html(mensaje);
        }
    });
}

function agregarInsumo(event) {
    event.preventDefault(); // Evita que el formulario se envíe a la nada

    // Rescatar valores del formulario
    var formulario = document.getElementById('formInsumos');
    var nombre = formulario.elements['nombre'].value;
    var categoria = formulario.elements['id_categoria'].value;
    var perecible = formulario.elements['perecible'].checked;
    var formato = formulario.elements['id_formato'].value;
    var imagenInput = formulario.elements['imagen'];

    var parametros = new FormData();
    parametros.append('nombre', nombre);
    parametros.append('categoria', categoria);
    parametros.append('perecible', Number(perecible));
    parametros.append('formato', formato);
    parametros.append('imagen', imagenInput.files[0]);
    parametros.append('opcion', 'guardar');

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_insumo.php',
        type: 'POST',
        contentType: false, //desactivar para que jQuery no lo configure incorrectamente
        processData: false, //desactivar para que jQuery no convierta FormData en cadena

        beforeSend: function () {
            mostrarInsumos();
        },

        success: function (mensaje) {
            alert(mensaje);
            mostrarInsumos();
            document.getElementById("formInsumos").reset(); // Limpia el formulario
        }
    });
}

function mostrarInsumos(){
    var parametros =
    {
        "opcion":"mostrar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_insumo.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#mostrarInsumos').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#mostrarInsumos').html(mensaje);
        }
    });
}

function editarInsumo(id) {

    var imagenIMG = document.getElementById('imagenIMG'+id);
    var imagenInput = document.getElementById('imagenINP'+id);
    var nombreSpan = document.getElementById('nombreSpanI'+id);
    var nombreTxt = document.getElementById('nombreTxtI'+id);
    var perecibleSpan = document.getElementById('perecibleSpan'+id);
    var perecibleSelect = document.getElementById('perecibleSelect'+id);
    var categoriaSpan = document.getElementById('categoriaSpanI'+id);
    var categoriaSelect = document.getElementById('categoriaSelectI'+id);
    var formatoSpan = document.getElementById('formatoSpanI'+id);
    var formatoSelect = document.getElementById('formatoSelectI'+id); 
    var btnEdit = document.getElementById('btnInsumoEdit'+id);   
    var btnOK = document.getElementById('guardarInsumoEdit'+id);
   

    // Mostrar el campo de texto y ocultar el span
    
    btnEdit.style.display='none';
    btnOK.style.display='inline';
    imagenIMG.style.display='none';
    imagenInput.style.display='inline';
    nombreSpan.style.display='none';
    nombreTxt.style.display='inline';
    perecibleSpan.style.display='none';
    perecibleSelect.style.display='inline';
    categoriaSpan.style.display='none';
    categoriaSelect.style.display='inline';
    formatoSpan.style.display='none';
    formatoSelect.style.display='inline';
    
    

}

function guardarInsumoEdit(id){

    var imagenIMG = document.getElementById('imagenIMG'+id);
    var imagenInput = document.getElementById('imagenINP'+id);
    var nombreSpan = document.getElementById('nombreSpanI'+id);
    var nombreTxt = document.getElementById('nombreTxtI'+id);
    var perecibleSpan = document.getElementById('perecibleSpan'+id);
    var perecibleSelect = document.getElementById('perecibleSelect'+id);
    var categoriaSpan = document.getElementById('categoriaSpanI'+id);
    var categoriaSelect = document.getElementById('categoriaSelectI'+id);
    var formatoSpan = document.getElementById('formatoSpanI'+id);
    var formatoSelect = document.getElementById('formatoSelectI'+id);    
    var btnOK = document.getElementById('guardarInsumoEdit'+id);
    var btnEdit = document.getElementById('btnInsumoEdit'+id);
    
    //rescatar y cargar datos a un formulario
    var parametros = new FormData();
    parametros.append('id', id)
    parametros.append('nombre', nombreTxt.value);
    parametros.append('categoria', categoriaSelect.value);
    parametros.append('perecible', perecibleSelect.value);
    parametros.append('formato', formatoSelect.value);
    parametros.append('ruta_imagen', imagenIMG.src);
    parametros.append('imagen', imagenInput.files[0]);
    parametros.append('opcion', 'editar');

    //volver elementos a estado anterior
    imagenIMG.style.display='inline';
    imagenInput.style.display='none';
    nombreSpan.style.display='inline';
    nombreTxt.style.display='none';
    perecibleSpan.style.display='inline';
    perecibleSelect.style.display='none';
    categoriaSpan.style.display='inline';
    categoriaSelect.style.display='none';
    formatoSpan.style.display='inline';
    formatoSelect.style.display='none';
    btnEdit.style.display='inline';
    btnOK.style.display='none';


    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_insumo.php',
        type: 'POST',
        contentType: false, //desactivar para que jQuery no lo configure incorrectamente
        processData: false, //desactivar para que jQuery no convierta FormData en cadena

        beforeSend: function () {
           mostrarInsumos();
        },

        success: function (mensaje) {
            mostrarInsumos();
        }
    });
    mostrarInsumos();
}

function eliminarInsumo(id){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar el insumo: "+id+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id,
            "opcion" : 'eliminar'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_insumo.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#mostrarInsumos').html("Error! No se puede realizar la operación.");
        $('#mostrarInsumos').css('color', 'red');
        mostrarInsumos();
        },

        success: function(mensaje)
        {
        $('#mostrarInsumos').html(mensaje);
        mostrarInsumos();
        }
        
        });

        mostrarInsumos();

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
//-------------------------    LOGICA POPUP FORMATOS     -----------------------------------
//------------------------------------------------------------------------------------------

function mostrarFormatos(){
    var parametros =
    {
        "opcion":"mostar"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_formato.php',
        type: 'POST',
        
        beforesend: function()
        {
        $('#verFormatos').html("Error de comunicación");
        },

        success: function(mensaje)
        {
        $('#verFormatos').html(mensaje);
        }
    });
}

function agregarFormato(event){ 
    
    event.preventDefault(); // Evita que el formulario se envíe a la nada
    // rescatar valores del form
    var formulario = document.getElementById('formFormatos');    
    var nombre = formulario.elements['nombre'].value;

    var parametros = 
    {
        "nombre" : nombre,
        "opcion" : 'guardar'
    };
    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_formato.php',
        type: 'POST',
        
        beforeSend: function()
        {
        },

        success: function(mensaje)
        {            
            
        }
        
    });
    
    document.getElementById("formFormatos").reset(); //limpia formulario
    mostrarFormatos();

}

function editarFotmato(id) {

    var formatoSpan = document.getElementById('nombre_formatoSpan'+id);
    var formatoTxt = document.getElementById('nombre_formatoTxt'+id);
    var btnOK = document.getElementById('guardarEditFotmato'+id);
    var btnEdit = document.getElementById('btnEditFotmato'+id);

    // Mostrar el campo de texto y ocultar el span
    formatoSpan.style.display = 'none';
    formatoTxt.style.display = 'inline';
    btnEdit.style.display = 'none';
    btnOK.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    formatoTxt.value = formatoSpan.innerText;

}

function guardarFotmatoEdit(id){

    var formatoSpan = document.getElementById('nombre_formatoSpan'+id);
    var formatoTxt = document.getElementById('nombre_formatoTxt'+id);
    var btnOK = document.getElementById('guardarEditFotmato'+id);
    var btnEdit = document.getElementById('btnEditFotmato'+id);



    var parametros = 
    {
        "id" : id,
        "nombre" : formatoTxt.value,
        "opcion" : 'editar'
    };
    formatoSpan.style.display = 'inline';
    formatoTxt.style.display = 'none';
    btnEdit.style.display = 'inline';
    btnOK.style.display = 'none';

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_formato.php',
        type: 'POST',
        
        beforeSend: function()
        {
            mostrarFormatos();
        },

        success: function(mensaje)
        {
            mostrarFormatos();
        }
        
        

    });
    mostrarFormatos();
    
}

function eliminarAlmacen(id){

    var confirmacion = confirm("¿Estás seguro de que deseas eliminar el formato: "+id+"?");

    if (confirmacion) {
        
        var parametros = 
        {
            "id" : id,
            "opcion" : 'eliminar'
        };                

        $.ajax({
        data: parametros,
        url: '../Controlador/gestion_formato.php',
        type: 'POST',
        
        beforeSend: function()
        {
        $('#verFormatos').html("Error! No se puede realizar la operación.");
        $('#verFormatos').css('color', 'red');
        mostrarFormatos();
        },

        success: function(mensaje)
        {
        $('#verFormatos').html(mensaje);
        mostrarFormatos();
        }
        
        });

        mostrarFormatos();

    }
}
