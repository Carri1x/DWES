<?php

namespace App\Class;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Coche implements \JsonSerializable
{
    private UuidInterface $uuid;
    private string $marca;
    private string $usuario;
    private array $revisiones;

    public function __construct(UuidInterface $uuid, string $marca, string $usuario){
        $this->uuid = $uuid;
        $this->marca = $marca;
        $this->usuario = $usuario;
        $this->revisiones = [];
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function setUuid(UuidInterface $uuid): Coche
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getMarca(): string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): Coche
    {
        $this->marca = $marca;
        return $this;
    }

    public function getUsuario(): string{
        return $this->usuario;
    }

    public function setUsuario(string $usuario): Coche{
        $this->usuario = $usuario;
        return $this;
    }

    public function getRevisiones(): array
    {
        return $this->revisiones;
    }

    public function setRevisiones(array $revisiones): Coche
    {
        $this->revisiones = $revisiones;
        return $this;
    }


    public function jsonSerialize(): mixed
    {
        return[
            'id' => $this->uuid->toString(),
            'marca' => $this->marca,
            'usuario' => $this->usuario,
            'revisiones' => $this->revisiones
        ];
    }

    public static function build (string $marca, string $usuario): Coche {
        $uuid = Uuid::uuid4();
        return new Coche($uuid, $marca, $usuario);
    }



    public static function fromArrayToCoche(array $array): Coche {
        return new Coche(Uuid::fromString($array['uuid']), $array['marca'], $array['usuario']);
    }
}