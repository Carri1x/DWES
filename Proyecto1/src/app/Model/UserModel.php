<?php

namespace App\Model;

use App\Class\User;
use App\Enum\TipoUsuario;
use Ramsey\Uuid\Uuid;

class UserModel
{
    public static function getAllUsers():array{
        return [
            new User(
                Uuid::uuid4(),
                "Pablo",
                "1234",
                "pablito@gmail.com",
            ),
            new User(
                Uuid::uuid4(),
                "Aurelio",
                "1234",
                "aure@gmail.com",
            )
        ];
    }

    public static function getUserById(string $id):User{
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
}