<?php

declare(strict_types=1);

namespace App\Auth\Domain\ValueObjects;

use InvalidArgumentException;

final readonly class Email
{
    public function __construct(public string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email inválido.");
        }
    }
}
