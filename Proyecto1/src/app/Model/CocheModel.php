<?php

namespace App\Model;

use App\Class\Coche;
use PDO;
use PDOException;
class CocheModel
{
    public static function saveCoche(Coche $coche): bool {
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "alvaro", "alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            return false;
        }
        $sql = "INSERT INTO coche VALUES (:id, :marca, :usuario, :revisiones)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue("id", $coche->getId());
        $stmt->bindValue("marca", $coche->getMarca());
        $stmt->bindValue("usuario", $coche->getUsuario());
        $stmt->bindValue("revisiones", $coche->getRevisiones());
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}