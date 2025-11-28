<?php

namespace App\Controller;

use App\Class\Coche;

class CocheController
{
    public function index(){
        include DIR_VIEWS . "inicio.php";
    }

    public function formularioCoche(){
        include DIR_VIEWS . "formularioInsertarCoche.php";
    }

    /**
     * Esta función llegan los datos del formulario para guardarlos en la base de datos.
     * @return void
     */
    public function store(){
        if(isset($_POST["marca"]) && isset($_POST["usuario"])){
            $coche = Coche::build($_POST['marca'], $_POST['usuario']);

        }

    }
}