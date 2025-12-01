<?php
include_once 'vendor/autoload.php';
include_once 'env.php';

use App\Controller\CocheController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;

$router = new RouteCollector();

/***************************************************************************************/
/**
 * Te da la opción de elegir entre insertar un coche o crear una revisión.
 */
$router->get('/', [CocheController::class, 'index']);

/**
 * - get - Vamos a la dirección para que nos enseñe el formulario - index -.
 * Para Insertar un nuevo coche.
 */
$router->get('/add/coche', [CocheController::class, 'formularioCoche']);
/**
 * - post - para enviar los datos del coche y guardarlo a la base de datos.
 */
$router->post('/add/coche', [CocheController::class, 'store']);


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