<?php

namespace App\Controller;

use App\Class\Coche;
use App\Class\Revision;
use App\Model\CocheModel;
use App\Model\RevisionModel;

class RevisionController
{
    public function index(){
        include_once DIR_VIEWS.'formularioInsertarRevision.php';
    }
    public function add(){
        echo"Por lo menos esta entrando";
        if(isset($_POST['nombre']) && isset($_POST['precio'])){
            $coche = CocheModel::getCocheByMarca($_POST['marca']);
            $coche = Coche::fromArrayToCoche($coche);
            if($coche != null){
                $precio = intval($_POST['precio']); //Esto hace que pueda parsear de string a int
                $revision = new Revision($_POST['nombre'], $precio, $coche);

                //Insertamos la revisión en la base de datos.
                if(RevisionModel::saveRevision($revision, $coche)){
                    echo "Se ha guardado la revision correctamente";
                } else {
                    echo "Ocurrio un error al guardar la revision";
                }
            } else {
                echo "El coche es null";
            }
        } else {
            echo "No están entrando bien los datos del formulario";
        }
    }
}