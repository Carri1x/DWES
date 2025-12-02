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
     * En esta función llegan los datos del formulario para guardarlos en la base de datos.
     * @return void
     */
    public function store(){
        //Si existe la marca y el nombre del usuario del coche crearemos el coche y lo mandamos a la base de datos.
        if(isset($_POST["marca"]) && isset($_POST["usuario"])){
            $coche = Coche::build($_POST['marca'], $_POST['usuario']);
            if(CocheModel::saveCoche($coche)){
                echo "El coche fue registrado correctamente";
            } else {
                echo "El coche no pudo ser registrado";
            }
        }
    }

    /**
     * Función que enseña todos los coches que hay en la base de datos.
     * @return void
     */
    public function show(){
        $cochesDataBase = CocheModel::getAll();
        $coches = [];
        foreach($cochesDataBase as $coche){
            $coches[] = Coche::fromArrayToCoche($coche);
        }
        include DIR_VIEWS . "todosLosCoches.php";
    }

    /**
     * Función que elimina un coche.
     */
    public function destroy($uuid){
        var_dump($uuid);
        if(CocheModel::deleteCoche($uuid)){
            return "El coche {$uuid} ha sido eliminado";
        } else {
            return "El coche {$uuid} no pudo ser eliminado";
        }
    }


}