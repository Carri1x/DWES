<?php

namespace App\Controller;

use App\Interface\ControllerInterface;

class DirectorController implements ControllerInterface
{
    public function index(){
        return "Los directores son: ";
    }

    public function delete($id){
        return "Voy a borrar el director $id...";
    }

    function show($id)
    {
        // TODO: Implement show() method.
    }

    function store()
    {
        // TODO: Implement store() method.
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