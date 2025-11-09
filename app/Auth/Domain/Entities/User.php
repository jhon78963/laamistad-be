<?php

declare(strict_types=1);

namespace App\Auth\Domain\Entities;

use App\Auth\Domain\ValueObjects\Email;
use App\Auth\Domain\ValueObjects\HashedPassword;
use App\Auth\Domain\ValueObjects\UserId;

final class User
{
    /**
     * User constructor.
     *
     * @param UserId $id
     * @param string $name
     * @param Email $email
     * @param HashedPassword $password
     */
    public function __construct(
        public readonly UserId $id,
        public readonly string $name,
        public readonly Email $email,
        private HashedPassword $password
    ) {
    }

    public static function create(
        UserId $id,
        string $name,
        Email $email,
        HashedPassword $password
    ): self {
        if (empty(trim($name))) {
            throw new \InvalidArgumentException('El nombre del usuario no puede estar vacío.');
        }

        if (strlen($name) < 3) {
            throw new \InvalidArgumentException('El nombre debe tener al menos 3 caracteres.');
        }

        $bloqueados = ['tempmail.com', 'mailinator.com', 'yopmail.com'];
        $dominio = substr(strrchr($email->value, "@"), 1);
        if (in_array($dominio, $bloqueados)) {
            throw new \InvalidArgumentException("No se permiten correos del dominio $dominio.");
        }

        return new self($id, $name, $email, $password);
    }

    public function getHashedPassword(): string
    {
        return $this->password->value;
    }
}
