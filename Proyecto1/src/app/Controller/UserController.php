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
        foreach ($usuarios as $usuario) {
            var_dump($usuario);
        }
        return $usuarios;
    }

    function show($id)
    {
        //TODO: Method to implement.
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
        // TODO: Implement edit() method.
    }

    function verify(){
        $_POST['username'];
        $_POST['password'];

        //Si es correcto el Login..
        $_SESSION['username'] = $_POST['username'];
    }
}