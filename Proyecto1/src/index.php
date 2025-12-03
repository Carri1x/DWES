<?php
include_once 'vendor/autoload.php';
include_once 'env.php';

use App\Class\Coche;
use App\Controller\CocheController;
use App\Controller\RevisionController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;

$router = new RouteCollector();

$router->get('/fun', function () {
   $fecha = new DateTime();
   echo $fecha->format('Y-m-d')."   ";
   $fecha->modify('+30 day');
   echo $fecha->format('Y-m-d');
   $sql = "INSERT INTO user VALUES :nombre, :edad, STR_TO_DATE(:fecha, '%d/%c/%Y') ";
    $uuid = \App\Model\CocheModel::getCocheByMarca('1234');
    echo "Aquí Uuid: ".$uuid->getUuid()->toString();
    try{
        $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "alvaro", "alvaro");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        return null;
    }
    $sql = "SELECT * FROM coche WHERE uuid = :uuid";
    $stmt = $conexion->prepare($sql);
    $stmt->bindValue("uuid", $uuid->getUuid()->toString());
    $stmt->execute();
    $cochecito  = Coche::fromArrayToCoche($stmt->fetch(PDO::FETCH_ASSOC));
    echo "  Matricula: ".$cochecito->getMarca();
    echo "  Usuario: ".$cochecito->getUsuario();
    echo "  Uuid: ".$cochecito->getUuid();
});

/***************************************************************************************/
/**
 * Te da la opción de elegir entre insertar un coche o crear una revisión.
 */
$router->get('/', [CocheController::class, 'index']);

/**
 * Muestra todos los coches que hay registrados en la base de datos.
 */
$router->get('/coches',[CocheController::class, 'show']);

/**
 * - get - Vamos a la dirección para que nos enseñe el formulario - index -.
 * Para Insertar un nuevo coche.
 */
$router->get('/add/coche', [CocheController::class, 'formularioCoche']);

/**
 * - post - para enviar los datos del coche y guardarlo a la base de datos.
 */
$router->post('/add/coche', [CocheController::class, 'store']);

/**
 * - delete - Eliminamos el coche que se ha pasado el uuid por parámetro.
 */
$router->delete('/delete/coche/{uuid}', [CocheController::class, 'destroy']);

/*************************************************************************************************
 * End Points Revisiones.
 */
$router->get('/add/revision', [RevisionController::class, 'index']);

$router->post('/add/revision', [RevisionController::class, 'add']);

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