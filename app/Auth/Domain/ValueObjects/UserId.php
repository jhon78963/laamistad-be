<?php

declare(strict_types=1);

namespace App\Auth\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;

final readonly class UserId
{
    public function __construct(public string $value)
    {
        if (!Uuid::isValid($value)) {
            throw new \InvalidArgumentException("ID de usuario inválido.");
        }
    }

    public static function next(): self
    {
        return new self(Uuid::uuid4()->toString());
    }
}
