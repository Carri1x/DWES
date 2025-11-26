<?php

namespace App\Class;

use Ramsey\Uuid\UuidInterface;

class Coche implements \JsonSerializable
{
    private UuidInterface $id;
    private string $nombre;
    private array $revisiones;

    public function __construct(UuidInterface $id, string $nombre){
        $this->id = $id;
        $this->nombre = $nombre;
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

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Coche
    {
        $this->nombre = $nombre;
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
            'nombre' => $this->nombre,
            'revisiones' => $this->revisiones
        ];
    }
}