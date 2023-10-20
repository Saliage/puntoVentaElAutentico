<?php

namespace Lib;

class Ruta
{
    private static $rutas = [];

    // agrega rutas de metodo GET
    public static function get($uri, $callback)
    {
        $uri = substr($uri,55,null);
        self::$rutas['GET'][$uri] = $callback;
    }

    // agrega rutas de metodo POST
    public static function post($uri, $callback)
    {   
        $uri = substr($uri,55,null);
        self::$rutas['POST'][$uri] = $callback;
    }
        
    //recuperar URI
    public static function dispatch()
    {
        $uri =$_SERVER['REQUEST_URI'];
        $uri = substr($uri,55,null);

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$rutas[$method] as $ruta => $callback)
        {
            echo "| $ruta , $uri |"; 
            if($ruta == $uri)
            {
                $callback();
                return;
                
            }
        }

        //echo '404 Not Found';
    }


}



?> 