<?php

namespace App\Model;

use App\Class\Coche;
use PDO;
use PDOException;
class CocheModel
{

    public static function getAll(){
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "alvaro", "alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        $sql = "SELECT * FROM coche";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public static function saveCoche(Coche $coche): bool {
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "alvaro", "alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            return false;
        }
        $sql = "INSERT INTO coche (uuid, marca, usuario) VALUES (:uuid, :marca, :usuario)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue("uuid", $coche->getUuid());
        $stmt->bindValue("marca", $coche->getMarca());
        $stmt->bindValue("usuario", $coche->getUsuario());
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public static function deleteCoche($uuid): bool{
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "alvaro", "alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            return false;
        }
        $sql = "DELETE FROM coche WHERE uuid = :uuid";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue("uuid", $uuid);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public static function getCocheByUuid($uuid): ?Coche{
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "alvaro", "alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            return null;
        }
        $sql = "SELECT * FROM coche WHERE uuid = :uuid";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue("uuid", $uuid);
        $stmt->execute();
        return Coche::fromArrayToCoche($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public static function getCocheByMarca($marca):?Coche{
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "alvaro", "alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            return null;
        }

        $sql = "SELECT * FROM coche WHERE marca = :marca";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue("marca", $marca);
        $stmt->execute();
        return Coche::fromArrayToCoche($stmt->fetch(PDO::FETCH_ASSOC));
    }
}