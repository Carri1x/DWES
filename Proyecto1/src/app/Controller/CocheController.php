<?php

namespace App\Controller;

use App\Class\Coche;
use App\Model\CocheModel;

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
        //Si existe la marca y el nombre del usuario del coche crearemos el coche y lo mandamos a la base de datos.
        if(isset($_POST["marca"]) && isset($_POST["usuario"])){
            $coche = Coche::build($_POST['marca'], $_POST['usuario']);
            CocheModel::saveCoche($coche);

        }

    }
}