<?php
// Verifica si cURL está habilitado
if (function_exists('curl_init')) {
    echo 'cURL está habilitado en tu servidor.';
} else {
    echo 'cURL NO está habilitado en tu servidor.';
}
