<?php

declare(strict_types=1);

namespace App\Auth\Domain\ValueObjects;

final readonly class HashedPassword
{
    public function __construct(public string $value)
    {
        // Un hash de BCRYPT siempre tiene 60 caracteres
        if (strlen($value) !== 60) {
            throw new \InvalidArgumentException("Password no parece estar hasheado.");
        }
    }
}
