<?php

namespace App\Controller;

use App\Class\User;
use App\Enum\TipoUsuario;
use App\Interface\ControllerInterface;
use App\Model\UserModel;
use http\Exception\BadConversionException;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as Validator;

class UserController implements ControllerInterface
{

    function index()
    {
        $usuarios = UserModel::getAllUsers();
        include_once DIRECTORIO_VISTAS_BACKEND.'User/allusers.php';
    }

    function show($id)
    {
        if(isset($_SESSION['username'])){
            //Muestra la vista con los datos del usuario.
        } else {
            //Muestra una vista de no se puede acceder a estos datos.
        }
        return "Estos son los datos del usuario $id";
    }

    function createBackendUser(){
        $tipos = TipoUsuario::getAllTipos();
        include_once DIRECTORIO_VISTAS_BACKEND.'User/createuser.php';
    }
    /**
        Funcion que valida el usuario y lo inserta en la base de datos.+
     */
    function store()
    {
        $user = User::validateUserCreation($_POST);
        if(is_array($user)){

        } else {
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
            UserModel::saveUser($user);
        }
        $usuarios = UserModel::getAllUsers();
        include_once DIRECTORIO_VISTAS_BACKEND.'User/allusers.php';
    }
    function destroy($id)
    {
        $mensaje = '';
        if(UserModel::deleteUser($id)){
            $mensaje = 'El usuario se ha eliminado correctamente';
        } else {
            http_response_code(418);
            return;
        }
        http_response_code(200);
        return json_encode([
            "error" => false,
            "mensaje" => $mensaje,
            "code" => 200
        ]);
    }

    function create()
    {
        // TODO: Implement create() method.
    }

    function update($id) //Este es la ruta ->>> post('user/{id}',[UserController::class, 'update']);
    {
        parse_str(file_get_contents("php://input"),$editData);
        $editData["uuid"] = $id; //Insertamos el id dentro de editData para que no de error en validateUserEdit($editData);
        var_dump($editData);

        $errores = User::validateUserEdit($editData);
        if(!$errores){ //Si no hay errores update user
            $userDatabase = UserModel::getUserById($id); //Seleccionamos el usuario de la base de datos.

            User::createFromArray($editData);
        }else{
            //Aquí tendría un error.
            http_response_code(401);
            return json_encode([
                "errors" => true,
                "messages" => $errores,
                "code" => 401
            ]);
        }


        $tipos = TipoUsuario::getAllTipos();
        // Viene de la vista useredit... ahora toca modificar el usuario, subirlo y traerlo a la misma vista.

        include_once DIRECTORIO_VISTAS_BACKEND.'User/useredit.php';
    }
    function edit($id) //Esta es la ruta ->>> get('user/{id}/edit',[UserController::class, 'edit']);
    {
        //Recuperar los datos de un usuario del Modelo.
        $usuario = UserModel::getUserById($id);
        $tipos = TipoUsuario::getAllTipos();
        //Llamar a la vista que muestre los datos del usuario
        include_once DIRECTORIO_VISTAS_BACKEND.'User/useredit.php';
    }

    function verify(){
        /*$_POST['username'];
        $_POST['password'];*/

        var_dump($_POST);

        //Si es correcto el Login..
        $_SESSION['username'] = $_POST['username'];
        var_dump($_SESSION['username']);
    }

    function show_login(){
        include_once "app/Views/frontend/login.php";
    }

    function show_register(){
        include_once "app/Views/frontend/register.php";
    }

    function register(){
        //var_dump($_POST);
        $usuario = User::validateUserCreation($_POST);
        if($usuario == []){
            echo "Lo siento te has flipado con los datos";
            return ;
        }
        $_SESSION["username"] = $usuario->getUsername();
        $type = $usuario->getTipo()->name;
        if($type == "ADMIN"){
            include_once DIRECTORIO_VISTAS_BACKEND."inicio.php";
            echo 'eres admin';
        } elseif ($type == "ANUNCIOS"){
            include_once DIRECTORIO_VISTAS_BACKEND."inicio.php";
            echo 'eres de anuncios';
        } else {
            include_once DIRECTORIO_VISTAS_FRONTEND."inicio.php";
            echo 'eres normal';
        }
        //include_once DIRECTORIO_TEMPLATE_FRONTEND."inicio.php";
    }

    function logout(){
        session_destroy();
    }
}