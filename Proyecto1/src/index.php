<?php
include_once "vendor/autoload.php";
include_once "env.php";
//Directiva para insertar o utilizar la clase RouteCollector (End Points).
use App\Controller\UserController;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;
use App\Controller\DirectorController;

$router = new RouteCollector();
//Definir las rutas de mi aplicación.

$router-> get('/', function (){
   return "Estoy en la página de principal ";
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
        return 'Tienes que pasar por parámetro los numeros y letras.';
    }
        $cantNumeros = $_GET['numeros'];
        $cantLetras = $_GET['letras'];
        include_once './auxiliar/funciones.php';
        $password = generarPassword($cantNumeros, $cantLetras);

        include_once './views/password.php';
});

$router -> post('/form-pelicula', function(){

});

var_dump($_SERVER['REQUEST_METHOD']);
//----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
//---------- Practica hacer login y registrar NETFLIX ------------
//  FUNCIONA
$router->get('/users',[UserController::class, 'index']); //GetAllUsers()


$router -> get('/login', [UserController::class, 'show_login']);
$router->post('/user/login', [UserController::class, 'verify']);

//Registrar al usuario primero enseñarle la vista registro
$router -> get('/register', [UserController::class, 'show_register']);
//Si ha ido todu bien enviarlo a la vista que se ha registrado
$router -> post('/user/register', [UserController::class, 'register']);

//Crear usuarios dentro del Backend (supuesto sitio Admin)
//  FUNCIONA
$router -> get('create/user', [UserController::class, 'createBackendUser']); //Enseñamos el form para crear el usuario.
//  FUNCIONA
$router -> post('create/user', [UserController::class, 'store']); //Hacemos comprobaciones para enviarlo a la base de datos.


//Editar usuarios.
$router->get('user/{id}',[UserController::class, 'edit']); //Del GetAllUsers nos mandan un uuid que enseñamos aquí el formulario para editar al usuario.
$router->put('user/{id}',[UserController::class, 'update']); //Recogemos los datos, los verificamos, editamos si está bien y enseñamos los datos (vista) del usuario editado.
$router->delete('user/{id}',[UserController::class, 'destroy']); //Desde GetAllUsers nos mandan un uuid y borramos en la base de datos el usuario.

//Deslogearlo
$router -> get('/logout', [UserController::class, 'logout']);

//----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------




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

