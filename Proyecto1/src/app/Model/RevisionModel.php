<?php

namespace App\Model;

use App\Class\Coche;
use App\Class\Revision;
use PDO;
use PDOException;

class RevisionModel
{
    public static function saveRevision(Revision $revision, Coche $coche): bool {
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1;", "alvaro", "alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            return false;
        }
        $correctaEjecucion = false;

        $sql = "INSERT INTO revision (uuid, nombre, precio, uuid_coche)
        VALUES (:uuid, :nombre, :precio, :uuid_coche)";
        $stmt = $conexion->prepare($sql);

        $stmt->bindValue(":uuid", $revision->getUuid());
        $stmt->bindValue(":nombre", $revision->getNombre());
        $stmt->bindValue(":precio", $revision->getPrecio());
        $stmt->bindValue(":uuid_coche", $coche->getUuid());

        $stmt->execute();


        return $stmt->rowCount() > 0;
    }
}