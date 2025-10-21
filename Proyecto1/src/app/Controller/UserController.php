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

        $usuarios = UserModel::getAllusers();
        foreach ($usuarios as $usuario) {
            var_dump($usuario);
        }
    }

    function show($id)
    {
        //TODO: Method to implement.
    }

    function store()
    {
        $user = User::validateUser($_POST);
        var_dump($user);
        return "";
    }

    function update($id)
    {
        parse_str(file_get_contents("php://input"),$editData);
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
}