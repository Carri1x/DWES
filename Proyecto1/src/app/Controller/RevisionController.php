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
        if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['uuidCoche'])){
            $coche = CocheModel::getCocheByUuid($_POST['uuidCoche']);
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
            }
        }
    }
}