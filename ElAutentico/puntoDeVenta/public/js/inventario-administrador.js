
//funcion "onload" la principal que llama a las demás funciones necesarias para completar
// los formularios que requieren datos desde la BD
function inicializar(){

    inicializarInventario();
    listarAlmacenesZona();
    mostrarZonas();
    mostrarAlmacenes();    
    mostrarProveedores();
    mostrarTipoMovimientos();
}

//------------------------------------------------------------------------------------------
//---------------------------    LOGICA POPUP ZONAS     ------------------------------------
//------------------------------------------------------------------------------------------


function listarAlmacenesZona(){

       var parametros =
    {
        "opcion":"ver"
    }

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_almacen.php',
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
            mostrarZonas();
        },

        success: function(mensaje)
        {            
            mostrarZonas();
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
            mostrarZonas();
        },

        success: function(mensaje)
        {
            mostrarZonas();
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
        "opcion":"mostrar"
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

function agregarAlmacen() {
    // Rescatar valores del formulario
    var nombre = document.getElementById('nombreAlmacenTxt').value;
    var sala_venta = document.getElementById('sala_chk').checked ? 1 : 0;

    var parametros = {
        "nombre": nombre,
        "sala_venta": sala_venta,
        "opcion": 'guardar'
    };

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_almacen.php',
        type: 'POST',
        beforeSend: function () {
            mostrarAlmacenes();
        },
        success: function (mensaje) {
            mostrarAlmacenes();
            listarAlmacenesZona();
        }
    });

    $('#nombreAlmacenTxt').val("");  // Restablecer valor del campo
    mostrarAlmacenes();
    listarAlmacenesZona();
}


function editarAlmacen(id_almacen) {

    var almacenSpan = document.getElementById('nombre_almacenSpan'+id_almacen);
    var almacenTxt = document.getElementById('nombre_almacenTxt'+id_almacen);
    var sala_ventaSpan = document.getElementById('sala_ventaSpan'+id_almacen);
    var sala_ventachk = document.getElementById('sala_ventachk'+id_almacen);
    var btnOK = document.getElementById('guardarEditAlmacen'+id_almacen);
    var btnEdit = document.getElementById('btnEditAlmacen'+id_almacen);

    // Mostrar el campo de texto y ocultar el span
    almacenSpan.style.display = 'none';
    almacenTxt.style.display = 'inline';
    sala_ventaSpan.style.display = 'none';
    sala_ventachk.style.display = 'inline';    
    btnEdit.style.display = 'none';
    btnOK.style.display = 'inline';

    // Agregar el valor del texto al valor original del span
    almacenTxt.value = almacenSpan.innerText;

}

function guardarAlmacenEdit(id_almacen){

    var almacenSpan = document.getElementById('nombre_almacenSpan'+id_almacen);
    var almacenTxt = document.getElementById('nombre_almacenTxt'+id_almacen);
    var sala_ventaSpan = document.getElementById('sala_ventaSpan'+id_almacen);
    var sala_ventachk = document.getElementById('sala_ventachk'+id_almacen);
    var btnOK = document.getElementById('guardarEditAlmacen'+id_almacen);
    var btnEdit = document.getElementById('btnEditAlmacen'+id_almacen);


    var parametros = 
    {
        "id" : id_almacen,
        "nombre" : almacenTxt.value,
        "sala_venta" : Number(sala_ventachk.checked),
        "opcion" : 'editar'
    };
    almacenSpan.style.display = 'inline';
    almacenTxt.style.display = 'none';    
    sala_ventaSpan.style.display = 'inline';
    sala_ventachk.style.display = 'none';    
    btnEdit.style.display = 'inline';
    btnOK.style.display = 'none';

    $.ajax({
        data: parametros,
        url: '../Controlador/gestion_almacen.php',
        type: 'POST',
        
        beforeSend: function()
        {
            mostrarAlmacenes();
        },

        success: function(mensaje)
        {
            mostrarAlmacenes();
            listarAlmacenesZona();
        }
        
        

    });
    mostrarAlmacenes();
    listarAlmacenesZona();
    
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

    if(validarRut(rut)){

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
    else{

        $('#validaRUT').html('El RUT no es válido. Por favor, corrige el RUT.');
        document.getElementById("rut").value ="";
    }
}

function validarRutTxt() {
    var rut = document.getElementById("rut").value;
    var mensaje = document.getElementById("validaRUT");

    if (validarRut(rut)) {
        mensaje.style.display = 'none';
    } else {
        mensaje.style.display = 'block';
        mensaje.innerHTML = 'El RUT no es válido. Por favor, corrige el RUT.';
    }
}


function validarRut(rut) {
    // Eliminar puntos y guiones del RUT
    rut = rut.replace(/[.-]/g, '');

    // Verificar si el RUT tiene el formato correcto
    if (!/^[0-9]{1,9}[0-9Kk]$/.test(rut)) {
        return false;
    }

    // Obtener el dígito verificador actual
    var dv = rut.slice(-1);
    rut = rut.slice(0, -1);

    // Calcular el dígito verificador esperado
    var suma = 0;
    var multiplo = 2;

    for (var i = rut.length - 1; i >= 0; i--) {
        suma += rut[i] * multiplo;

        if (multiplo < 7) {
            multiplo++;
        } else {
            multiplo = 2;
        }
    }

    var digitoVerificadorCalculado = 11 - (suma % 11);

    // Convertir el dígito calculado a texto
    digitoVerificadorCalculado = (digitoVerificadorCalculado === 10) ? 'K' : String(digitoVerificadorCalculado);

    // Comparar el dígito verificador actual con el calculado
    return dv.toUpperCase() === digitoVerificadorCalculado.toUpperCase();
}

function mostrarProveedores(){
    var parametros =
    {
        "opcion":"mostrar"
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
        "id" : id,
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

//------------------------------------------------------------------------------------------
//------------------------     LOGICA POPUP PROVEEDORES    ---------------------------------
//------------------------------------------------------------------------------------------


    function agregarMovimiento() {

        // Rescatar valores del formulario
        var nombre = document.getElementById('tipo_movimientoTXT').value;

        var parametros = {
            "nombre": nombre,
            "opcion": 'guardar'
        };

        $.ajax({
            data: parametros,
            url: '../Controlador/gestion_movimiento.php',
            type: 'POST',
            beforeSend: function () {
            },
            success: function (mensaje) {
            }
        });

        $('#tipo_movimientoTXT').val("");  // Restablecer valor del campo
        mostrarTipoMovimientos();
    }

    function mostrarTipoMovimientos(){
        var parametros =
        {
            "opcion":"mostrar"
        }

        $.ajax({
            data: parametros,
            url: '../Controlador/gestion_movimiento.php',
            type: 'POST',
            
            beforesend: function()
            {
            $('#verTipoMovimiento').html("Error de comunicación");
            },

            success: function(mensaje)
            {
            $('#verTipoMovimiento').html(mensaje);
            }
        });
    }

    function editarmovimeinto(id) {

        var movimeintoSpan = document.getElementById('nombre_movimeintoSpan'+id);
        var movimeintoTxt = document.getElementById('nombre_movimeintoTxt'+id);
        var btnEdit = document.getElementById('btnEditMovimiento'+id);
        var btnOK = document.getElementById('guardarEditMovimiento'+id);
        

        // Mostrar el campo de texto y ocultar el span
        movimeintoSpan.style.display = 'none';
        movimeintoTxt.style.display = 'inline';   
        btnEdit.style.display = 'none';
        btnOK.style.display = 'inline';

    }

    function guardarmovimeintoEdit(id){

        var movimeintoSpan = document.getElementById('nombre_movimeintoSpan'+id);
        var movimeintoTxt = document.getElementById('nombre_movimeintoTxt'+id);
        var btnEdit = document.getElementById('btnEditMovimiento'+id);
        var btnOK = document.getElementById('guardarEditMovimiento'+id);
        
        var parametros = 
        {
            "id" : id,
            "nombre" : movimeintoTxt.value,
            "opcion" : 'editar'
        };
        
        // revertir elementos
        movimeintoSpan.style.display = 'inline';
        movimeintoTxt.style.display = 'none';   
        btnEdit.style.display = 'inline';
        btnOK.style.display = 'none';

        $.ajax({
            data: parametros,
            url: '../Controlador/gestion_movimiento.php',
            type: 'POST',
            
            beforeSend: function()
            {
                mostrarTipoMovimientos();
            },

            success: function(mensaje)
            {
                mostrarTipoMovimientos();
            }
            
            

        });
        mostrarTipoMovimientos();
        
    }

    function eliminarmovimeinto(id){

        var confirmacion = confirm("¿Estás seguro de que deseas eliminar el tipo de movimiento: "+id+"?");

        if (confirmacion) {
            
            var parametros = 
            {
                "id" : id,
                "opcion" : 'eliminar'
            };                

            $.ajax({
            data: parametros,
            url: '../Controlador/gestion_movimiento.php',
            type: 'POST',
            
            beforeSend: function()
            {
            $('#verTipoMovimiento').html("Error! No se puede realizar la operación.");
            $('#verTipoMovimiento').css('color', 'red');
            mostrarTipoMovimientos();
            },

            success: function(mensaje)
            {
            $('#verTipoMovimiento').html(mensaje);
            mostrarTipoMovimientos();
            }
            
            });

            mostrarTipoMovimientos();

        }
    }
