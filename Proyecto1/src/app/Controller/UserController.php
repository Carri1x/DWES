<?php

namespace App\Controller;

use App\Class\User;
use App\Interface\ControllerInterface;
use App\Model\UserModel;
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

    function store()
    {
        $user = User::validateUserCreation($_POST);
        var_dump($user);
        return "";
    }

    function update($id)
    {
        parse_str(file_get_contents("php://input"),$editData);
        $usuario = User::validateUserEdit($editData);
        var_dump($editData);
    }

    function destroy()
    {
        // TODO: Implement destroy() method.
    }

    function create()
    {
        // TODO: Implement create() method.
    }

    function edit($id)
    {
        //Recuperar los datos de un usuario del Modelo.
        $usuario = UserModel::getUserById($id);

        //Llamar a la vista que muestre los datos del usuario
        include_once DIRECTORIO_VISTAS_BACKEND.'User/editUsers.php';
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