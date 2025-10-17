<?php

namespace App\Controller;

class DirectorController implements ControllerInterface
{
    public function index(){
        return "Los directores son: ";
    }

    public function delete($id){
        return "Voy a borrar el director $id...";
    }
}