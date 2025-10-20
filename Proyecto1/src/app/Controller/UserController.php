<?php

namespace App\Controller;

use App\Class\User;
use App\Interface\ControllerInterface;
use App\Model\UserModel;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Validator as Validator;

class UserController implements ControllerInterface
{

    function index()
    {

        $usuarios = UserModel::getAllusers();
        //return json_encode([$usuario, $usuario2]);
    }

    function show($id)
    {
        // TODO: Implement show() method.
    }

    function store()
    {
        Validator::key('username', Validator::stringType())
            ->key('password', Validator::password()->length(3,16))
            ->key('email', Validator::email())
            ->key('edad', Validator::intType()->min(18))
            ->key('type', Validator::in(["normal", "anuncios", "admin"]))
            ->assert($_POST); // You can also use check() or isValid()
        return "";
    }

    function update($id)
    {
        // TODO: Implement update() method.
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