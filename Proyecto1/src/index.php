<?php
include_once "vendor/autoload.php";
include_once "env.php";
//Directiva para insertar o utilizar la clase RouteCollector (End Points).
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;
use App\Controller\DirectorController;

$router = new RouteCollector();
//Definir las rutas de mi aplicación.

$router-> get('/', function (){
   return "Estoy en la página de principal";
});

$router -> get('/admin', function (){
    include_once "views/indice.php";
});

/*$router -> get('/pass', function (){
    if(!isset($_GET['numeros']) && !isset($_GET['letras'])){
        echo 'Tienes que pasar por parámetro los numeros y letras';
    } else {
        $cantNumeros = $_GET['numeros'];
        $cantLetras = $_GET['letras'];
        include_once './auxiliar/funciones.php';
        echo generarPassword($cantNumeros, $cantLetras);
    }
});*/

$router -> get('/pass', function () {
    if (!isset($_GET['numeros']) && !isset($_GET['letras'])) {
        return 'Tienes que pasar por parámetro los numeros y letras';
    }
        $cantNumeros = $_GET['numeros'];
        $cantLetras = $_GET['letras'];
        include_once './auxiliar/funciones.php';
        $password = generarPassword($cantNumeros, $cantLetras);

        include_once './views/password.php';
});

$router -> post('/form-pelicula', function(){

});

$router->get('/user',[UserController::class, 'index']);
$router -> get('/user/{id}',[UserController::class,'show']);
$router -> post('/user', [UserController::class,'store']);
$router -> put('/user',[UserController::class,'update']);
$router -> delete('/user',[UserController::class,'destroy']);

$router -> post('/user/create', [UserController::class,'create']);
$router -> post('/user/{id}/edit', [UserController::class,'edit']);

$router->get('/movie',[MovieController::class, 'index']);
$router -> get('/movie/{id}', [MovieController::class,'show']);
$router -> post('/movie', [MovieController::class,'store']);
$router -> put('/movie',[MovieController::class,'update']);
$router -> delete('/movie',[MovieController::class,'destroy']);

$router -> post('/movie/create', [MovieController::class,'create']);
$router -> post('/movie/{id}/edit', [MovieController::class,'edit']);

//Rutas de Director CRUD
$router-> get('/director', [DirectorController::class, 'index']);
$router-> get('director/{id}', [DirectorController::class, 'show']);
$router-> post('/director', [DirectorController::class,'store']);
$router-> put('/director/{id}', [DirectorController::class,'update']);
$router-> delete('director/{id}', [DirectorController::class,'destroy']);


//Resolver la ruta que debemos cargar.
# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

try {
    $response = $dispatcher->
    dispatch($_SERVER['REQUEST_METHOD'],
        parse_url($_SERVER['REQUEST_URI'],
            PHP_URL_PATH));
}catch (HttpRouteNotFoundException $e){
    //En caso de que no se inserte una ruta definida presentamos la página 404 not found.
    include_once 'views/404.php';
    die();
}
// Print out the value returned from the dispatched function
echo $response;

