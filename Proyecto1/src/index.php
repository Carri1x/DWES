<?php
include_once 'vendor/autoload.php';

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;

$router = new RouteCollector();

/***************************************************************************************/

$router->get('/', function () {
   echo 'Hello World!';
});

/**
 * - get - Vamos a la dirección para que nos enseñe el formulario - index -.
 * Insertar un coche.
 */
$router->get('/add/coche', [CocheController::class, 'index']);


/***************************************************************************************/

//Vamos a hacer que la ruta pueda cargar la ruta
$dispacher = new Dispatcher($router ->getData());

try{
    $response = $dispacher->dispatch(
        $_SERVER['REQUEST_METHOD'],
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}catch(HttpRouteNotFoundException $e){
    //En caso de que no se inserte una ruta definida presentamos la página 404 not found.
    echo $e->getMessage();
    echo "Aquí la página 404 no encontrado";
    die();
}

echo $response;