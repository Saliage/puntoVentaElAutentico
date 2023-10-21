<?php
require_once "../lib/Ruta.php";
use Lib\Ruta;

Ruta::GET('',function(){
    echo 'desde acá se puede cargar pagina principal';
});

Ruta::get('administrador',function(){
    echo 'desde acá se puede cargar pagina administrador';
});

Ruta::get('vendedor',function(){
    echo 'desde acá se puede cargar pagina vendedor';
});

//test

Ruta::dispatch();

?>