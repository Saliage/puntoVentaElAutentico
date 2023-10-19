<?php

namespace Lib;

class Ruta
{
    private static $rutas = [];

    // agrega rutas de metodo GET
    public static function get($uri, $callback)
    {
        self::$rutas['GET'][$uri] = $callback;
    }

    // agrega rutas de metodo POST
    public static function post($uri, $callback)
    {        
        self::$rutas['POST'][$uri] = $callback;
    }
        
}



?> 