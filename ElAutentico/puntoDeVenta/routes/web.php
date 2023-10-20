<?php

use lib\Ruta;

Ruta::get('',function(){
    echo 'desde acá se puede cargar pagina principal';
});

Ruta::get('/administrador',function(){
    echo 'desde acá se puede cargar pagina administrador';
});

Ruta::get('/vendedor',function(){
    echo 'desde acá se puede cargar pagina vendedor';
});


Ruta::dispatch();

?>