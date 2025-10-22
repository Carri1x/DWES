<?php

namespace App\Model;

use App\Class\User;
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
}