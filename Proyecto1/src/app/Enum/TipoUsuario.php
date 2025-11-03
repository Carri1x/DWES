<?php

namespace App\Enum;

enum TipoUsuario
{
    case NORMAL;
    case ANUNCIOS;
    case ADMIN;

    public static function stringToUserType(string $tipo) : TipoUsuario {
        return match(strtolower($tipo)){
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
