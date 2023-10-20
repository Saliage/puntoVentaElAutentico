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
        
    //recuperar URI
    public static function dispatch()
    {
        $uri =$_SERVER['REQUEST_URI'];
        echo $uri;

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes[$method] as $rutas => $callback)
        {
            if($rutas == $uri)
            {
                $callback();
                return;
            }
        }

        echo '404 Not Found';
    }


}



?> 