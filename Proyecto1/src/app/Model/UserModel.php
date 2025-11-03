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

    public static function getUserById(string $id):User{
        //TODO: implementarlo con la base de datos.
        $usuario = new User(
            Uuid::fromString($id),
            "Pablo",
            "1234",
            "pablou@gmail.com",
            TipoUsuario::NORMAL
        );
        $usuario -> setEdad(18);
        return $usuario;
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


    /*
    public static function getUserByUsername(string $username):User{
        //TODO: implementarlo con la base de datos.
        return null;
    } */

}