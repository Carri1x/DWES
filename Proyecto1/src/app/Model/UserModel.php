<?php

namespace App\Model;

use App\Class\User;
use App\Enum\TipoUsuario;
use PDO;
use PDOException;
use Ramsey\Uuid\Uuid;

class UserModel
{
    public static function getAllUsers():?array{
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1;","alvaro","alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo $e->getMessage();
            return null;
        }
        $sql = "SELECT * FROM user";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($resultado){
            $usuarios = [];
            foreach ($resultado as $user){
                //usuarios[] los corchetes quiere decir ponlo al final.
                $usuarios[]=User::createFromArray($user);
            }
            return $usuarios;
        } else {
            return null;
        }
    }

    public static function getUserById(string $uuid):?User
    {
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1;","alvaro","alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo $e->getMessage();
            return null;
        }

        $sql = "SELECT * FROM user WHERE uuid = :uuid";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':uuid', $uuid);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if($resultado){

            return User::createFromArray($resultado);
        } else {
            return null;
        }
    }

    public static function saveUser(User $user): bool{
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=proyecto1;","alvaro","alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }

        $sql = "INSERT INTO user values(:uuid, :username, :password, :email, :edad, :tipo)";

        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bindValue('uuid', $user->getUuid());
        $sentenciaPreparada->bindValue('username', $user->getUsername());
        $sentenciaPreparada->bindValue('password', $user->getPassword());
        $sentenciaPreparada->bindValue('email', $user->getEmail());
        $sentenciaPreparada->bindValue('edad', $user->getEdad());
        $sentenciaPreparada->bindValue('tipo', $user->getTipo()->name);

        $sentenciaPreparada->execute();

        if($sentenciaPreparada->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public static function deleteUser(string $uuid): bool{
        try{
            $conexion = new PDO('mysql:host=mariadb;dbname=proyecto1;', "alvaro", "alvaro");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
        $sql = "DELETE FROM user WHERE uuid = :uuid";
        $stmt = $conexion->prepare($sql);
        # $stmt->bindParam(':uuid', $uuid); Esta función hace que pueda cambiar el valor de uuid ¡Sirve para recorrer en un for!
        $stmt->bindValue('uuid', $uuid);
        $stmt->execute();

        if($stmt->rowCount() > 0){ //Si ha devuelto la información (fila) de que se ha eliminado el usuario.
            return true;
        } else {
            return false; // No se ha podido eliminar al usuario.
        }
    }


    public static function updateUser(User $user): bool{
        try{
            $conexion = new PDO('mysql:host=mariadb;dbname=proyecto1;', 'alvaro', 'alvaro');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        $sql = "UPDATE user SET username = :username, email = :email, edad = :edad, tipo = :tipo WHERE uuid = :uuid ";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue('username', $user->getUsername());
        $stmt->bindValue('email', $user->getEmail());
        $stmt->bindValue('edad', $user->getEdad());
        $stmt->bindValue('tipo', $user->getTipo()->name);
        $stmt->bindValue('uuid', $user->getUuid());
        $stmt->execute();

        return true; //Se ha podido ejecutar el editado del usuario.
    }
    /*
    public static function getUserByUsername(string $username):User{
        //TODO: implementarlo con la base de datos.
        return null;
    } */

}