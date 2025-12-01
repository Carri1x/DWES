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
        $sql = "INSERT INTO coche (:uuid, :marca, :usuario) VALUES (:uuid, :marca, :usuario)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue("uuid", $coche->getUuid());
        $stmt->bindValue("marca", $coche->getMarca());
        $stmt->bindValue("usuario", $coche->getUsuario());
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}