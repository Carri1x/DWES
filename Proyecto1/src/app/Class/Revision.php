<?php

namespace App\Class;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Revision implements \jsonSerializable
{
    private UuidInterface $id;
    private string $nombre;
    private int $precio;

    public function __construct(string $nombre, int $precio){
        //Aquí delegamos al código que ponga el uuid que considere.
        $this->id = Uuid::uuid4();
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'precio' => $this->precio
        ];
    }
}