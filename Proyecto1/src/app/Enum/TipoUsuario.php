<?php

namespace App\Enum;

enum TipoUsuario
{
    case NORMAL;
    case ANUNCIOS;
    case ADMIN;

    public static function stringToUserType(string $type) : TipoUsuario {
        return match(strtolower($type)){
            "normal"=>TipoUsuario::NORMAL,
            "anuncios"=>TipoUsuario::ANUNCIOS,
            "admin"=>TipoUsuario::ADMIN,
            default=>TipoUsuario::NORMAL
        };
    }

    public static function getAllTipos(): array {
        return array_map(fn($case) => $case->name, self::cases());
    }
}
