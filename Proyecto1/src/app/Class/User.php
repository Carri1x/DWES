<?php

namespace App\Class;
//Me falta que me inyecte automáticamente el use (namespace) de la clase enum de TipoUsuario.. si no.. es que está mal hecha la clase.

use App\Enum\TipoUsuario;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as Validator;

class User implements \JsonSerializable
{
    private UuidInterface $uuid;
    private string $username;
    private string $password;
    private string $email;
    private  int $edad;
    private array $visualizaciones;
    private TipoUsuario $tipo;

    public function __construct(UuidInterface $uuid, string $username, string $password, string $email, TipoUsuario $type = TipoUsuario::NORMAL){
        $this->uuid = $uuid;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->visualizaciones = [];
        $this->tipo = $type;
    }

    public function getTipo(): TipoUsuario
    {
        return $this->tipo;
    }

    public function setTipo(TipoUsuario $tipo): User
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function getVisualizaciones(): array
    {
        return $this->visualizaciones;
    }

    public function setVisualizaciones(array $visualizaciones): User
    {
        $this->visualizaciones = $visualizaciones;
        return $this;
    }

    public function getEdad(): int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): User
    {
        $this->edad = $edad;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function setUuid(UuidInterface $uuid): User
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "username" => $this->username,//No ponemos la contraseña para proteger los datos...
            "email" => $this->email,
            "edad" => $this->edad??"No Disponible",
            "visualizaciones" => $this->visualizaciones,
            "tipo" => $this->tipo->name,
        ];
    }

    public static function validateUserCreation(array $data): User | array
    {
        try {
            Validator::key('username', Validator::stringType())
                ->key('password', Validator::stringType()->length(3, 16))
                ->key('email', Validator::email())
                ->key('edad', Validator::intVal()->min(18))
                ->key('tipo', Validator::in(["NORMAL", "ANUNCIOS", "ADMIN"]))
                ->assert($_POST); // You can also use check() or isValid()
        } catch (NestedValidationException $errores) {
            foreach ($errores->getMessages() as $message) {
                var_dump($message);
            }
            return [];
        }
        $uuid = Uuid::uuid4();
        $usuario = new User(
            $uuid,
            $data['username'],
            $data['password'],
            $data['email'],
            TipoUsuario::stringToUserType($data['tipo'])
        );
        return $usuario->setEdad($data['edad']);
    }

    public static function validateUserEdit(array $data): array|false{
        try {
            Validator::key('uuid', Validator::uuid())
                ->key('username', Validator::stringType(),false)
                ->key('password', Validator::stringType()->length(3, 16),false)
                ->key('email', Validator::email(),false)
                ->key('edad', Validator::intVal()->min(18),false)
                ->key('tipo', Validator::in(["NORMAL", "ANUNCIOS", "ADMIN"]),false)
                ->assert($data); // You can also use check() or isValid()
        } catch (NestedValidationException $errores) {
            return $errores->getMessages();
        }
        return false; //Devolvemos el usuario con todos los datos comprobados.
    }

    public static function createFromArray(array $data): User{
        $uuid = Uuid::fromString($data['uuid']); //Creo la interfaz del uuid que me venga como string.
        $usuario = new User(
            $uuid,
            $data['username'],
            $data['password'],
            $data['email'],
            TipoUsuario::stringToUserType($data['tipo'])
        );
        return $usuario->setEdad($data['edad']);
    }

    public static function editFromArray(User $antiguoUsuario,array $nuevosDatos):?User{

        $antiguoUsuario->setUsername($nuevosDatos['username']??$antiguoUsuario->getUsername());
        $antiguoUsuario->setUsername($nuevosDatos['edad']??$antiguoUsuario->getEdad());
        $antiguoUsuario->setUsername($nuevosDatos['tipo']??$antiguoUsuario->getTipo());
        $antiguoUsuario->setUsername($nuevosDatos['email']??$antiguoUsuario->getEmail());
        if (isset($nuevosDatos['password'])) {
            $antiguoUsuario->setPassword(password_hash($nuevosDatos['password'],PASSWORD_DEFAULT));
        }
        return $antiguoUsuario;
    }
}