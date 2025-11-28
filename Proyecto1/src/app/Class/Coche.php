<?php

namespace App\Class;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Coche implements \JsonSerializable
{
    private UuidInterface $id;
    private string $marca;
    private string $usuario;
    private array $revisiones;

    public function __construct(UuidInterface $id, string $marca, string $usuario){
        $this->id = $id;
        $this->marca = $marca;
        $this->usuario = $usuario;
        $this->revisiones = [];
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): Coche
    {
        $this->id = $id;
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
            'id' => $this->id,
            'nombre' => $this->marca,
            'revisiones' => $this->revisiones
        ];
    }

    public static function build (string $marca, string $usuario): Coche {
        $uuid = Uuid::uuid4();
        return new Coche($uuid, $marca, $usuario);
    }
}