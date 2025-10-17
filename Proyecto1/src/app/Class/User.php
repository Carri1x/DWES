<?php

namespace App\Class;
//Me falta que me inyecte automáticamente el use (namespace) de la clase enum de TipoUsuario.. si no.. es que está mal hecha la clase.

use App\Enum\TipoUsuario;

class User
{
    private string $username;
    private string $password;
    private string $email;
    private  int $edad;
    private array $visualizaciones;
    private TipoUsuario $tipo;
}