<?php

namespace App\Class;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Revision implements \jsonSerializable
{
    private UuidInterface $uuid;
    private string $nombre;
    private int $precio;

    public function __construct(string $nombre, int $precio){
        //Aquí delegamos al código que ponga el uuid que considere.
        $this->uuid = Uuid::uuid4();
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function setUuid(UuidInterface $uuid): Revision
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getPrecio(): int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): Revision
    {
        $this->precio = $precio;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Revision
    {
        $this->nombre = $nombre;
        return $this;
    }


    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->uuid->toString(),
            'nombre' => $this->nombre,
            'precio' => $this->precio
        ];
    }
}